<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $items = [];

    public $total = 0;

    protected $listeners = ['updateCart' => 'productAdded'];

    public function mount(CartService $cartService)
    {
        $this->items = $cartService->getShoppingCart();
        $this->total = $cartService->getCartTotal();
    }

    /* public function mount()
    {
        /*   array_push($this->items, [
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
        ]); */

    /*     public function increment()
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
        } */

    public function addToCart(CartService $cartService, int $productId)
    {
        $cartService->addToCart($productId, 1);
        $this->mount($cartService);
    }

    public function decrementFromCart(CartService $cartService, int $productId)
    {
        $cartService->decrementFromCart(intval($productId));
        $this->mount($cartService);
    }

    public function removeFromCart(CartService $cartService, int $productId)
    {

        $cartService->removeFromCart(intval($productId));

        $this->mount($cartService);
    }

    /*     #[On('updateCart')]
    public function productAdded($product, $quantity)
    {

        array_push($this->items, [
            'id'        => $product->id,
            'name'      => $product->name,
            'quantity'  => $quantity,
            'unitPrice' => $product->price,
            'subtotal'  => $product->price * $quantity,
        ]);

        // $this->render();
    } */

    /*    public function removeItem($id)
    {
        $this->items = array_filter($this->items, function ($item) use ($id) {
            return $item['id'] !== $id;
        });
    } */

    public function render()
    {
        return view('livewire.cart');
    }
}
