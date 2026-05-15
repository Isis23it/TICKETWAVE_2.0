<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo que representa un evento publicado en la plataforma.
 *
 * Pertenece a un organizador (User) y a un recinto (Venue).
 * Puede tener múltiples tipos de entrada (TicketType).
 * Solo los eventos con status 'published' son visibles al público.
 */
#[Fillable(['user_id', 'venue_id', 'name', 'description', 'category', 'image_url', 'status', 'event_date'])]
class Event extends Model
{
    use HasFactory;

    // ── Relaciones ─────────────────────────────────────────────

    /** El organizador que creó este evento */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** El recinto físico donde ocurre el evento */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /** Tipos de boleto disponibles para este evento */
    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }
}