<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cambiar_estado')
                ->label('Cambiar Estado')
                ->form([
                    Select::make('status')
                        ->label('Estado')
                        ->options([
                            'pending'   => 'Pendiente',
                            'confirmed' => 'Confirmado',
                            'cancelled' => 'Cancelado',
                        ])
                        ->default(fn () => $this->record->status)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $this->record->update(['status' => $data['status']]);
                    // Redirige a la misma vista del pedido sin usar Referer
                    $this->redirect($this->getResource()::getUrl('view', ['record' => $this->record]));
                }),
        ];
    }
}