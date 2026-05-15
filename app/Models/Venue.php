<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo que representa un recinto físico donde ocurren los eventos.
 * Un recinto puede tener múltiples eventos.
 */
#[Fillable(['name', 'city', 'state', 'neighborhood', 'country', 'postal_code', 'address', 'capacity', 'latitude', 'longitude', 'image_url', 'active'])]
class Venue extends Model
{
    use HasFactory;

    // ── Relaciones ─────────────────────────────────────────────

    /** Eventos que se realizan en este recinto */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}