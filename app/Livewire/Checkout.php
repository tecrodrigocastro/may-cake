<?php

namespace App\Livewire;

use App\Models\Adreesse;
use App\Services\CartService;
use Livewire\Component;

class Checkout extends Component
{
    public $items = [];

    public $total = 0;

    public $delivery_price = 3.00;

    public $payment = '';

    public $user;

    public $addresses;
    public $selectedAddress;
    public $addressForm;

    public bool $showModal;

    public function mount(CartService $cartService)
    {
        $this->user = auth()->user();

        $this->addresses = $this->user->adreesses;

        $this->addressForm = new Adreesse();


        $this->items = $cartService->getShoppingCart();
        //$this->total = array_sum(array_column($this->items, 'subtotal'));
        $this->total = $cartService->getCartTotal();
    }

    public function selectAddress($addressId)
    {
        $this->selectedAddress = $this->addresses->firstWhere('id', $addressId);
    }
    public function loadAddress()
    {
        $this->addressForm = $this->addresses->find($this->selectedAddress);
    }


    public function addAddress()
    {
        $this->validate([
            'addressForm.cep' => 'required',
            'addressForm.street' => 'required',
            'addressForm.city' => 'required',
            'addressForm.neighborhood' => 'required',
        ]);

        $this->user->addresses()->create($this->addressForm->toArray());

        $this->addresses = $this->user->addresses;

        $this->addressForm = new Adreesse();
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
