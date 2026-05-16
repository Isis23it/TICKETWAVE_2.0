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

  /** @var array<string, string> Conversión automática de tipos */
  protected $casts = [
    'price' => 'decimal:2',
    'quantity_available' => 'integer',
    'quantity_sold' => 'integer',
    'max_per_order' => 'integer',
  ];

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
    // ── Accessors ──────────────────────────────────────────────

  /**
   * Retorna si aún quedan boletos disponibles para la venta.
   * Uso: $ticketType->has_stock → true/false
   */
  public function getHasStockAttribute(): bool
  {
    return ($this->quantity_available - $this->quantity_sold) > 0;
  }

  /**
   * Retorna la cantidad de boletos realmente vendibles.
   * Uso: $ticketType->stock_remaining → int
   */
  public function getStockRemainingAttribute(): int
  {
    return max(0, $this->quantity_available - $this->quantity_sold);
  }
}
