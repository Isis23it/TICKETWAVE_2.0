<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

/**
 * Policy para controlar acceso a eventos según el rol del usuario.
 *
 * admin → acceso total
 * organizer → solo sus propios eventos
 * comprador → solo lectura (viewAny y view)
 */
class EventPolicy
{
    /** Cualquier usuario autenticado puede ver el listado de eventos */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /** Cualquier usuario autenticado puede ver un evento específico */
    public function view(User $user, Event $event): bool
    {
        return true;
    }

    /** Solo admin y organizer pueden crear eventos */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'organizer']);
    }

    /**
     * Admin puede editar cualquier evento.
     * Organizer solo puede editar sus propios eventos.
     */
    public function update(User $user, Event $event): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'organizer' && $user->id === $event->user_id;
    }

    /**
     * Admin puede eliminar cualquier evento.
     * Organizer solo puede eliminar sus propios eventos.
     */
    public function delete(User $user, Event $event): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'organizer' && $user->id === $event->user_id;
    }

    public function restore(User $user, Event $event): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Event $event): bool
    {
        return $user->role === 'admin';
    }
}