<?php

namespace App\Policies;

use App\Models\TicketType;
use App\Models\User;

/**
 * Policy para controlar acceso a tipos de entrada según el rol.
 *
 * admin → acceso total
 * organizer → puede gestionar tipos de entrada de sus propios eventos
 * comprador → solo lectura
 */
class TicketTypePolicy
{
    /** Cualquier usuario autenticado puede ver tipos de entrada */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /** Cualquier usuario autenticado puede ver un tipo de entrada */
    public function view(User $user, TicketType $ticketType): bool
    {
        return true;
    }

    /** Solo admin y organizer pueden crear tipos de entrada */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'organizer']);
    }

    /**
     * Admin puede editar cualquier tipo de entrada.
     * Organizer solo puede editar tipos de entrada de sus propios eventos.
     */
    public function update(User $user, TicketType $ticketType): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'organizer' && $user->id === $ticketType->event->user_id;
    }

    /**
     * Admin puede eliminar cualquier tipo de entrada.
     * Organizer solo puede eliminar tipos de entrada de sus propios eventos.
     */
    public function delete(User $user, TicketType $ticketType): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'organizer' && $user->id === $ticketType->event->user_id;
    }

    public function restore(User $user, TicketType $ticketType): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, TicketType $ticketType): bool
    {
        return $user->role === 'admin';
    }
}