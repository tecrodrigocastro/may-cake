<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['total_price'] = $this->data['total_price'];
        //dump($data);

        return $data;
    }

    protected function beforeCreate(): void
    {

        //dump($this->data['products']);
        //$this->data['subtotal'] = $this->data['subtotal'];
    }
}
