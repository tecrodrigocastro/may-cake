<?php

namespace App\Livewire;

use App\Models\{Adreesse, Order};
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

    public bool $showModal = false;

    public $street;

    public $city;

    public $neighborhood;

    public $cep;

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
            'addressForm.cep'          => 'required',
            'addressForm.street'       => 'required',
            'addressForm.city'         => 'required',
            'addressForm.neighborhood' => 'required',
        ]);

        $this->user->addresses()->create($this->addressForm->toArray());

        $this->addresses = $this->user->addresses;

        $this->addressForm = new Adreesse();
    }

    public function save(CartService $service)
    {
        $messages = [
            'payment.required'         => 'Selecione uma forma de pagamento.',
            'selectedAddress.required' => 'Selecione um endereço de entrega.',
        ];

        $this->validate([
            'payment'         => 'required',
            'selectedAddress' => 'required',
        ], $messages);

        $order = Order::create([
            'adreesses_id' => $this->selectedAddress,
            'user_id'      => $this->user->id,
            'total_price'  => $this->total + $this->delivery_price,
            'payment'      => $this->payment,
            'status'       => 'new',
        ]);

        if ($order) {
            foreach ($this->items as $item) {
                $order->items()->create([
                    'product_id' => $item['id'],
                    'quantity'   => $item['quantity'],
                    'subtotal'   => $item['subtotal'],
                ]);
            }

            $service->clearCart();
            session()->flash('message', 'Pedido realizado com sucesso!');

            return redirect()->route('profile');
        }

        session()->flash('message', 'Erro ao realizar o pedido!');

        // save the order
        // redirect to thank you page
    }

    /*   public function registerAdreesse()
    {

        dd("cheguei aqui");

        $this->validate([
            'cep'          => 'required',
            'street'       => 'required',
            'city'         => 'required',
            'neighborhood' => 'required',
        ]);

        $this->user->adreesses()->create([
            'cep'          => $this->cep,
            'street'       => $this->street,
            'city'         => $this->city,
            'neighborhood' => $this->neighborhood,
        ]);

        $this->addresses = $this->user->adreesses;

        $this->showModal = false;
    } */

    public function render()
    {
        return view('livewire.checkout');
    }
}
