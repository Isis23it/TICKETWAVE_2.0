<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo que representa el pago de un pedido.
 * transaction_id es nullable porque se llena solo cuando
 * el proveedor de pagos confirma la transacción.
 */
#[Fillable(['order_id', 'payment_method', 'status', 'transaction_id', 'paid_at'])]
class Payment extends Model
{
    use HasFactory;

    // ── Relaciones ─────────────────────────────────────────────

    /** El pedido asociado a este pago */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}