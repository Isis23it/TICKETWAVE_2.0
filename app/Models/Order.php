<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Modelo que representa un pedido de boletos.
 * Un pedido pertenece a un usuario y puede tener múltiples items.
 * El pago se registra en la tabla payments asociada a este pedido.
 */
#[Fillable(['user_id', 'status', 'total_amount'])]
class Order extends Model
{
    use HasFactory;

    /** El comprador que realizó este pedido */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Items de boletos dentro de este pedido */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Alias de orderItems para compatibilidad con Filament */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Pago asociado a este pedido */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}