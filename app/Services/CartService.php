<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    public function addToCart(int $productId, int $quantity): array
    {
        // get data from session (this equals Session::get(), use empty array as default)
        $shoppingCart = session('shoppingCart', []);

        if (isset($shoppingCart[$productId])) {
            // product is already in shopping cart, increment the amount
            $shoppingCart[$productId]['quantity'] += $quantity;
            $shoppingCart[$productId]['subtotal'] = $shoppingCart[$productId]['quantity'] * $shoppingCart[$productId]['unitPrice'];
        } else {
            // fetch the product and add 1 to the shopping cart
            $product                  = Product::findOrFail($productId);
            $shoppingCart[$productId] = [
                'id'        => $productId,
                'quantity'  => $quantity,
                'unitPrice' => $product->price,
                'name'      => $product->name,
                'subtotal'  => $product->price * $quantity,
                'image'     => $product->images[0],
            ];
        }

        // update the session data (this equals Session::put() )
        session(['shoppingCart' => $shoppingCart]);

        return $shoppingCart;
    }

    public function decrementFromCart(int $productId): array | null
    {
        $shoppingCart = session('shoppingCart', []);

        if (!isset($shoppingCart[$productId])) {
            // should not happen, and should throw an error.
            return null;
        } else {
            if ($shoppingCart[$productId]['quantity'] == 1) {
                unset($shoppingCart[$productId]);
            } else {
                $shoppingCart[$productId]['quantity'] -= 1;
                $shoppingCart[$productId]['subtotal'] = $shoppingCart[$productId]['quantity'] * $shoppingCart[$productId]['unitPrice'];
            }
        }

        session(['shoppingCart' => $shoppingCart]);

        return $shoppingCart;
    }

    public function removeFromCart(int $productId): array | null
    {
        $shoppingCart = session('shoppingCart', []);

        if (!isset($shoppingCart[$productId])) {
            // should not happen, and should throw an error.
            return null;
        } else {
            unset($shoppingCart[$productId]);
        }

        session(['shoppingCart' => $shoppingCart]);

        return $shoppingCart;
    }

    public function getCartTotal(): float
    {
        $shoppingCart = session('shoppingCart', []);
        $total        = 0;

        foreach ($shoppingCart as $item) {
            $total += $item['subtotal'];
        }

        return $total;
    }

    public function clearCart(): void
    {
        $shoppingCart = session('shoppingCart', []);
        unset($shoppingCart);
    }

    public function getCartCount(): int
    {
        $shoppingCart = session('shoppingCart', []);
        $count        = count($shoppingCart);

        return $count;
    }

    public function getShoppingCart(): array
    {
        return session('shoppingCart', []);
    }
}
