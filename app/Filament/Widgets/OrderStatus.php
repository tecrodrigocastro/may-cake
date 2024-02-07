<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatus extends BaseWidget
{
    public $new = null;
    public $processing = null;
    public $delivered = null;
    public $total = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Pedidos novos', $this->new) ->description('Pedidos feitos hoje - '. date('d/m/Y')),
            Stat::make('Pedidos em preparo', $this->processing)->description('Pedidos feitos hoje - '. date('d/m/Y')),
            Stat::make('Pedidos entregues', $this->delivered)->description('Pedidos feitos hoje - '. date('d/m/Y')),
            Stat::make('Pedidos total', $this->total),

        ];
    }

    public function calculator()
    {
        $orders = Order::all();
        $this->total = $orders->count();
        $this->new = $orders->filter(function ($item) {
            return $item->status == 'new' && date('Y-m-d', strtotime($item->created_at)) == date('Y-m-d');
        })->count();
        $this->processing = $orders->filter(function ($item) {
            return $item->status == 'processing' && date('Y-m-d', strtotime($item->created_at)) == date('Y-m-d');
        })->count();
        $this->delivered = $orders->filter(function ($item) {
            return $item->status == 'delivered' && date('Y-m-d', strtotime($item->created_at)) == date('Y-m-d');
        })->count();


    }

    public function mount()
    {
        $this->calculator();
    }
}
