<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getProducts(Request $request)
    {
        $products = Product::all();

        return $this->success($products);
    }

    public function getProductById(Request $request)
    {
        $product = Product::find($request->id);

        return $this->success($product);
    }
}
