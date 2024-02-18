<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Profile extends Component
{

    public User $user;

    public  $orders;

    public array $status =  [
        'new' => 'Novo',
        'processing' => 'Em processo',
        'shipped' => 'Enviado',
        'delivered' => 'Entregue',
        'canceled' => 'Cancelado',
    ];

    public array $payment = [
        'pix' => 'Pix',
        'cash' => 'Dinheiro',
        'debit_card' => 'Cartão de débito',
        'credit_card' => 'Cartão de crédito',
    ];

    public function mount()
    {
        $this->user = auth()->user();

        /*         $this->orders = Order::where('user_id', $this->user->id)->orderBy('created_at', 'DESC')->get()->toArray();
 */
        $this->orders = Order::where('user_id', $this->user->id)
            ->selectRaw('*, DATE_FORMAT(created_at, "%d/%m/%Y") as formatted_created_at')
            ->orderBy('created_at', 'DESC')
            ->get();

            dump($this->orders);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
