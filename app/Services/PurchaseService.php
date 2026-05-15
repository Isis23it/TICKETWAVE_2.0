<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\TicketType;
use Illuminate\Support\Facades\DB;
use Exception;

class PurchaseService
{
    /**
     * Procesa la compra de boletos de forma atómica.
     * Usa DB::transaction() con lockForUpdate para evitar
     * condiciones de carrera cuando dos usuarios compran
     * el último boleto simultáneamente.
     */
    public function procesarCompra(int $userId, array $items, string $paymentMethod): Order
    {
        return DB::transaction(function () use ($userId, $items, $paymentMethod) {

            $totalAmount = 0;
            $validatedItems = [];

            foreach ($items as $item) {
                // lockForUpdate — bloqueo pesimista para evitar
                // que dos usuarios compren el mismo boleto al mismo tiempo
                $ticketType = TicketType::lockForUpdate()
                    ->findOrFail($item['ticket_type_id']);

                $available = $ticketType->quantity_available - $ticketType->quantity_sold;

                // si no hay suficientes boletos, lanza excepción
                // y revierte toda la transacción automáticamente
                if ($available < $item['quantity']) {
                    throw new Exception("Sin disponibilidad para: {$ticketType->name}");
                }

                $subtotal = $ticketType->price * $item['quantity'];
                $totalAmount += $subtotal;

                $validatedItems[] = [
                    'ticket_type'  => $ticketType,
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $ticketType->price,
                ];
            }

            // crear la orden
            $order = Order::create([
                'user_id'      => $userId,
                'status'       => 'confirmed',
                'total_amount' => $totalAmount,
            ]);

            foreach ($validatedItems as $item) {
                // crear cada item de la orden
                OrderItem::create([
                    'order_id'       => $order->id,
                    'ticket_type_id' => $item['ticket_type']->id,
                    'quantity'       => $item['quantity'],
                    'unit_price'     => $item['unit_price'],
                ]);

                // incrementar quantity_sold dentro de la transacción
                // para que el rollback también revierta este cambio si algo falla
                $item['ticket_type']->increment('quantity_sold', $item['quantity']);
            }

            // crear el pago asociado a la orden
            Payment::create([
                'order_id'       => $order->id,
                'payment_method' => $paymentMethod,
                'status'         => 'completed',
                'transaction_id' => uniqid('TXN-', true),
                'paid_at'        => now(),
            ]);

            return $order;
        });
    }
}