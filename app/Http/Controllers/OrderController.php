<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function store(Request $request)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'user_id'    => 'required|exists:users,id',
            'adreesses_id' => 'required|exists:adreesses,id',
            'payment' => 'required',
            'items' => 'required|array',
        ], [
            'user_id.required'    => 'Usuario é obrigatório',
            'user_id.exists'    => 'Usuario precisa ser válido',
            'adreesses_id.required'    => 'Endereço é obrigatório',
            'adreesses_id.exists'    => 'Endereço precisa ser válido',
            'payment.required' => 'Pagamento é obrigatório',
            'items.required' => 'Items é obrigatório',
            'items.array' => 'Items precisa ser um array',
        ]);



        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        $order_data = $request->all();

        $order = Order::create($order_data);

        if (!$order) {
            return $this->error('Erro ao criar pedido', 400);
        }

        foreach ($order_data['items'] as $item) {
            $order->items()->create($item);
        }

        return $this->success($order->with('items')->find($order->id));
    }

    public function getOrders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'    => 'required|exists:users,id',

        ], [
            'user_id.required'    => 'Usuario é obrigatório',
            'user_id.exists'    => 'Usuario precisa ser válido',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }


        $orders = Order::with('items')->where('user_id', $request->user_id)->get();

        return $this->success($orders);
    }
}
