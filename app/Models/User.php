<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Exceptions\NoDefaultPanelSetException;
/**
 * Modelo que representa a un usuario de la plataforma.
 *
 * Un usuario puede tener rol 'comprador', 'organizer' o 'admin'.
 * Como comprador realiza pedidos, como organizador crea eventos.
 */
#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ── Relaciones ─────────────────────────────────────────────

    /** Eventos creados por este usuario como organizador */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /** Pedidos realizados por este usuario como comprador */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    /**
     * Solo admin y organizer pueden acceder al panel de Filament.
     * Los compradores reciben 403 al intentar entrar a /admin.
     */
public function canAccessPanel(Panel $panel): bool
{
    if (!in_array($this->role, ['admin', 'organizer'])) {
        return false;
    }
    return true;
}
}