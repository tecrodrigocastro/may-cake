<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginCustomer extends Component
{
    public $email;

    public $password;

    public function render()
    {
        return view('livewire.login-customer');
    }

    public function mount()
    {
        if (auth()->check()) {
            return redirect()->to('/');
        }
    }

    public function login()
    {
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->to('/');
        } else {

            // dump('erro');
            session()->flash('error', 'Email or password is incorrect');
        }

        /*  if (auth()->attempt(['email' => $this->email, 'password' => Hash::make($this->password)])) {
            return redirect()->to('/');
        } else {
            dump('erro');
            session()->flash('error', 'Email or password is incorrect');
        } */
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->to('/login');
    }
}
