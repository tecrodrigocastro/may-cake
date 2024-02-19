<?php

namespace App\Livewire;

use App\Models\{Order, User};
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public $name;

    public $email;

    public $phone;

    public $cpf;

    public $orders;

    public array $status = [
        'new'        => 'Novo',
        'processing' => 'Em processo',
        'shipped'    => 'Enviado',
        'delivered'  => 'Entregue',
        'canceled'   => 'Cancelado',
    ];

    public array $payment = [
        'pix'         => 'Pix',
        'cash'        => 'Dinheiro',
        'debit_card'  => 'Cartão de débito',
        'credit_card' => 'Cartão de crédito',
    ];

    public function mount()
    {
        $this->user  = auth()->user();
        $this->name  = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->cpf   = $this->user->cpf;

        /*         $this->orders = Order::where('user_id', $this->user->id)->orderBy('created_at', 'DESC')->get()->toArray();
 */
        $this->orders = Order::where('user_id', $this->user->id)
            ->selectRaw('*, DATE_FORMAT(created_at, "%d/%m/%Y") as formatted_created_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function updateUser()
    {
        $this->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cpf'   => 'required',
        ]);

        $user_update = $this->user->update([
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cpf'   => $this->cpf,
        ]);

        if (!$user_update) {
            //$this->user = auth()->user();
            session()->flash('error', 'Erro ao atualizar perfil!');
        }
        session()->flash('message', 'Perfil atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
