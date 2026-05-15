<?php

namespace App\Policies;

use App\Models\Venue;
use App\Models\User;

/**
 * Policy para controlar acceso a recintos según el rol del usuario.
 *
 * admin → acceso total
 * organizer → solo lectura
 * comprador → solo lectura
 */
class VenuePolicy
{
    /** Cualquier usuario autenticado puede ver el listado de recintos */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /** Cualquier usuario autenticado puede ver un recinto específico */
    public function view(User $user, Venue $venue): bool
    {
        return true;
    }

    /** Solo admin puede crear recintos */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /** Solo admin puede editar recintos */
    public function update(User $user, Venue $venue): bool
    {
        return $user->role === 'admin';
    }

    /** Solo admin puede eliminar recintos */
    public function delete(User $user, Venue $venue): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Venue $venue): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Venue $venue): bool
    {
        return $user->role === 'admin';
    }
}