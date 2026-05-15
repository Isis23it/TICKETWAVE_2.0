<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo que representa un item dentro de un pedido.
 * Guarda el precio unitario al momento de la compra para
 * preservar el historial aunque el precio del ticket cambie después.
 */
#[Fillable(['order_id', 'ticket_type_id', 'quantity', 'unit_price'])]
class OrderItem extends Model
{
    use HasFactory;

    // ── Relaciones ─────────────────────────────────────────────

    /** El pedido al que pertenece este item */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /** El tipo de boleto de este item */
    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }
}