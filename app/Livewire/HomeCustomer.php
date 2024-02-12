<?php

namespace App\Livewire;

use Livewire\Component;

class HomeCustomer extends Component
{
    public $products = null;

    public function mount()
    {
        $this->products = \App\Models\Product::all();
    }

    public function render()
    {
        return view('livewire.home-customer');
    }
}
