<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class Product extends Component
{
    public $product = null;

    public $lastProducts = null;

    public $count = 1;

    public $cartCount;

    #[On('add-cart')]
    public function mount($id)
    {
        $cartService = new CartService();
        $this->product = ModelsProduct::find($id);

        $this->lastProducts = ModelsProduct::where('id', '!=', $id)->limit(3)->get();

        $this->cartCount = $cartService->getCartCount();
    }

    public function addToCart(CartService $cartService)
    {
        //$this->dispatch('updateCart', $this->product, $this->count);
        $cartService->addToCart($this->product->id, $this->count);

        $this->dispatch('add-cart', $this->product->id);
    }

    public function increment()
    {

        $this->count++;
    }

    public function decrement()
    {
        if ($this->count <= 1) {
            return;
        }
        $this->count--;
    }

    public function render()
    {
        return view('livewire.product');
    }
}
