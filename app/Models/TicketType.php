<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo que representa un tipo de boleto para un evento.
 * Usa decimal en precio para evitar errores de redondeo.
 */
#[Fillable(['event_id', 'name', 'description', 'quantity_available', 'quantity_sold', 'price', 'max_per_order'])]
class TicketType extends Model
{
    use HasFactory;

    // ── Relaciones ─────────────────────────────────────────────

    /** El evento al que pertenece este tipo de boleto */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /** Items de pedido asociados a este tipo de boleto */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}