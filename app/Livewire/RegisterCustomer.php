<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterCustomer extends Component
{
    public $name;
    public $email;
    public $cpf;
    public $password;

    public function render()
    {
        return view('livewire.register-customer');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'password' => Hash::make($this->password),
        ]);

        auth()->login($user);

        redirect()->to('/');


        /*       if ($user) {
            session()->flash('success', 'Cadastro realizado com sucesso');
            return redirect()->to('/login');
        }

        session()->flash('erro', 'Erro ao realizar login');
        redirect()->to('/login'); */
    }
}
