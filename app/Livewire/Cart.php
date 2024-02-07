<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $unitPrice = 20;

    public $quantity = 1;

    public $subtotal = 0;

    public $items = [];

    public function mount()
    {
        array_push($this->items, [
            'id'        => 1,
            'name'      => 'Product 1',
            'quantity'  => 1,
            'unitPrice' => 20,
            'subtotal'  => 20,
        ], [
            'id'        => 1,
            'name'      => 'Product 2',
            'quantity'  => 2,
            'unitPrice' => 40,
            'subtotal'  => 80,
        ]);
    }

    public function increment()
    {
        $this->quantity++;
        $this->subtotal = $this->unitPrice * $this->quantity;
    }

    public function decrement()
    {
        if ($this->quantity >= 1) {
            $this->quantity--;
            $this->subtotal = $this->unitPrice * $this->quantity;
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
