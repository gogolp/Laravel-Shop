<?php

namespace App\Service;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoyaltyService
{
    public function addPoints(array $data): void
    {
        $user = User::findOrFail($data['user_id']);

        Transaction::create([
            'user_id' => $user->id,
            'order_id' => $data['order_id'] ?? null,
            'type' => 'accrual',
            'amount' => $data['amount'],
            'description' => $data['description'] ?? 'Нарахування балів',
        ]);

        $user->increment('balance_it_coin', $data['amount']);
    }

    public function redeemPoints(array $data): void
    {
        $user = User::findOrFail($data['user_id']);

        if ($user->balance_it_coin < $data['amount']) {
            throw ValidationException::withMessages([
                'amount' => ['Недостатньо балів на балансі. Доступно: ' . $user->balance_it_coin],
            ]);
        }

        Transaction::create([
            'user_id' => $user->id,
            'order_id' => $data['order_id'] ?? null,
            'type' => 'redemption',
            'amount' => $data['amount'],
            'description' => $data['description'] ?? 'Списання балів',
        ]);

        $user->decrement('balance_it_coin', $data['amount']);
    }

    public function getBalance(int $id): int
    {
        return User::where('id', $id)->value('balance_it_coin');
    }
}

