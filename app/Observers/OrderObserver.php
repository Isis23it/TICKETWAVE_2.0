<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Cuando el estado cambia a "cancelled", se devuelven
     * los boletos — se decrementa quantity_sold sin bajar de 0.
     */
    public function updating(Order $order): void
    {
        if ($order->isDirty('status') && $order->status === 'cancelled') {
            foreach ($order->items as $item) {
                $ticketType = $item->ticketType;
                $newSold = max(0, $ticketType->quantity_sold - $item->quantity);
                $ticketType->update(['quantity_sold' => $newSold]);
            }
        }
    }
}