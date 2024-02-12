<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class Checkout extends Component
{
    public $items = [];

    public $total = 0;

    public $delivery_price = 3.00;

    public $payment = '';

    public function mount(CartService $cartService)
    {
        $this->items = $cartService->getShoppingCart();
        //$this->total = array_sum(array_column($this->items, 'subtotal'));
        $this->total = $cartService->getCartTotal();
    }

    public function save()
    {

        $this->validate([
            'payment' => 'required',
        ]);

        dump($this->only('payment'));


        // save the order
        // redirect to thank you page
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
