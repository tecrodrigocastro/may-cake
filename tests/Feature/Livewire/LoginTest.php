<?php

use App\Livewire\LoginCustomer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('logs in an existing user', function () {
    // Create a user to test with
    $user = User::create([
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    // Set up the Livewire component
    $component = Livewire::test(LoginCustomer::class)
        ->set('email', 'test@example.com')
        ->set('password', 'password');

    // Call the login method
    $component->call('login');

    // Assert that the user was logged in
    $this->assertAuthenticatedAs($user);
});

it('does not log in a user with incorrect credentials', function () {
    // Create a user to test with
    User::create([
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    // Set up the Livewire component
    $component = Livewire::test(LoginCustomer::class)
        ->set('email', 'test@example.com')
        ->set('password', 'wrong-password');

    // Call the login method
    $component->call('login');

    // Assert that the user was not logged in
    $this->assertGuest();
});

it('logs out an authenticated user', function () {
    // Create a user to test with
    $user = User::create([
        'name'     => 'Test User',
        'email'    => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    // Log in the user
    $this->actingAs($user);

    // Set up the Livewire component
    $component = Livewire::test(LoginCustomer::class);

    // Call the logout method
    $component->call('logout');

    // Assert that the user was logged out
    $this->assertGuest();
});
