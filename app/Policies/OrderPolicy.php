<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

/**
 * Policy para controlar acceso a pedidos según el rol del usuario.
 *
 * admin → acceso total
 * organizer → puede ver pedidos de sus eventos
 * comprador → solo puede ver y crear sus propios pedidos
 */
class OrderPolicy
{
    /** Admin y organizer pueden ver todos los pedidos. Comprador solo los suyos */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'organizer', 'comprador']);
    }

    /**
     * Admin ve cualquier pedido.
     * Comprador solo ve sus propios pedidos.
     */
    public function view(User $user, Order $order): bool
    {
        if ($user->role === 'admin') return true;
        return $user->id === $order->user_id;
    }

    /** Solo compradores pueden crear pedidos */
    public function create(User $user): bool
    {
        return $user->role === 'comprador';
    }

    /**
     * Admin puede actualizar cualquier pedido.
     * Comprador no puede modificar pedidos ya creados.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }

    /** Solo admin puede cancelar/eliminar pedidos */
    public function delete(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }
}