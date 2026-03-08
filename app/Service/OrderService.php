<?php

namespace App\Service;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderService
{
    public function __construct(
        private LoyaltyService $loyaltyService,
    ) {
    }

    public function create(array $data, User $user): Order
    {
        $total_amount_uah = 0;
        $total_amount_coins = 0;
        $order_items = [];

        foreach ($data['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            $total_amount_uah += $product->price_uah * $item['quantity'];
            $total_amount_coins += ($product->price_it_coins ?? 0) * $item['quantity'];

            $order_items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_at_moment' => $product->price_uah,
            ];
        }

        // Оплата монетами
        $use_coins = $data['use_coins'] ?? false;
        $paid_coins = 0;

        if ($use_coins && $total_amount_coins > 0) {
            $this->loyaltyService->redeemPoints([
                'user_id' => $user->id,
                'amount' => $total_amount_coins,
                'description' => 'Оплата замовлення монетами',
            ]);
            $paid_coins = $total_amount_coins;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'location_id' => $data['location_id'],
            'total_amount_uah' => $use_coins ? 0 : $total_amount_uah,
            'total_amount_coins' => $paid_coins,
            'status' => 'pending',
        ]);

        $order->items()->createMany($order_items);

        // Кешбек нараховується тільки при оплаті гривнями
        if (!$use_coins) {
            OrderPlaced::dispatch($order);
        }

        return $order;
    }

    public function update(Order $order, array $data): Order
    {
        if (isset($data['items'])) {
            $total_amount_uah = 0;
            $order_items = [];

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $total_amount_uah += $product->price_uah * $item['quantity'];

                $order_items[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_moment' => $product->price_uah,
                ];
            }

            $data['total_amount_uah'] = $total_amount_uah;

            $order->items()->delete();
            $order->items()->createMany($order_items);
        }

        $order->update($data);

        return $order;
    }

    public function delete(Order $order): void
    {
        $order->items()->delete();
        $order->delete();
    }
}

