<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Адмін має доступ до всього.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Юзер може переглядати тільки свої замовлення.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->user_id;
    }

    /**
     * Юзер може оновлювати тільки своє замовлення, і лише якщо статус — pending.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->id === $order->user_id && $order->status === 'pending';
    }

    /**
     * Юзер може видаляти тільки своє замовлення, і лише якщо статус — pending.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->id === $order->user_id && $order->status === 'pending';
    }
}
