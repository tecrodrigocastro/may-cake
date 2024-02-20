<?php

use App\Livewire\Checkout;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;

uses(RefreshDatabase::class);

it('saves an order', function () {
    // Create a user to test with
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $user->adreesses()->create([
        'street' => 'Test Street',
        'city' => 'Test City',
        'neighborhood' => 'Test Neighborhood',
        'cep' => '12345-678',
    ]);

    // Create a product to test with
    $product = Product::create([
        'name' => 'Test Product',
        'price' => 100,
        'description' => 'Test Description',
        'images' => '["test.jpg"]',
        // Add other product fields here
    ]);

    // Set up the Livewire component
    $component = Livewire::test(Checkout::class)
        ->set('user', $user)
        ->set('items', [
            [
                'id' => $product->id,
                'quantity' => 1,
                'subtotal' => $product->price,
            ],
        ])
        ->set('selectedAddress', 1)
        ->set('payment', 'credit_card')
        ->set('total', $product->price)
        ->set('delivery_price', 0);

    // Call the save method
    $component->call('save', new CartService());

    // Assert that the order was created
    $this->assertDatabaseHas('orders', [
        'user_id' => $user->id,
        'total_price' => $product->price,
        'payment' => 'credit_card',
        'status' => 'new',
    ]);

    // Assert that the order item was created
    $this->assertDatabaseHas('order_product', [
        'product_id' => $product->id,
        'quantity' => 1,
        'subtotal' => $product->price,
    ]);
});
