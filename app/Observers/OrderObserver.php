<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     * Usamos updated en lugar de updating para que solo se ejecute
     * si el guardado en BD fue exitoso.
     */
    public function updated(Order $order): void
    {
        // Verificar si el estado cambió a 'cancelled'
        if ($order->wasChanged('status') && $order->status === 'cancelled') {
            foreach ($order->items as $item) {
                $ticketType = $item->ticketType;
                // Devolver los boletos vendidos (disminuir quantity_sold)
                $newSold = max(0, $ticketType->quantity_sold - $item->quantity);
                $ticketType->update(['quantity_sold' => $newSold]);
            }
        }
    }
}