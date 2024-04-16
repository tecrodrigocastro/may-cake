<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Events\SendStatusNotification;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use function Livewire\on;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $order = $this->record;

        if ($order->isDirty('status')) {
           SendStatusNotification:dispatch($order->user_id, $order->status);
        }

        on(
            'echo.private:status.' . $order->user_id,
            function ($status) {
                $this->emit('statusUpdated', $status);
            }
        );


    }
}
