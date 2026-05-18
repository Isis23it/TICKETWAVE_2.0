<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;

/**
 * Modelo que representa a un usuario de la plataforma.
 *
 * Un usuario puede tener rol 'comprador', 'organizer' o 'admin'.
 * Como comprador realiza pedidos, como organizador crea eventos.
 */
#[Fillable(['name', 'email', 'password', 'role', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
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

    // ── Filament ───────────────────────────────────────────────

    /**
     * Solo admin y organizer pueden acceder al panel de Filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'organizer']);
    }

    // ── Helpers de rol ─────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isOrganizer(): bool
    {
        return $this->role === 'organizer';
    }

    public function isComprador(): bool
    {
        return $this->role === 'comprador';
    }

    // ── Accessors ──────────────────────────────────────────────

    /**
     * Retorna la URL pública del avatar o null si no tiene.
     * Uso: $user->avatar_url
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar) {
            return Storage::disk('public')->url($this->avatar);
        }
        return null;
    }

    /**
     * Retorna la inicial del nombre en mayúscula.
     * Uso: $user->avatar_inicial → 'L'
     */
    public function getAvatarInicialAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }
    /**
 * Avatar que muestra Filament en el navbar.
 */
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }
}