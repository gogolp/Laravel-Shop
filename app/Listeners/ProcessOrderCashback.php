<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessOrderCashback
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order->load('items.product');
        $cashback_coins = 0;

        foreach ($order->items as $item) {
            $cashback_coins += floor(
                $item->price_at_moment * $item->quantity * ($item->product->cashback_percent / 100)
            );
        }

        if($cashback_coins > 0){
            Transaction::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'type' => 'accrual',
                'amount' => $cashback_coins,
                'description' => 'Кешбек за замовлення №' . $order->id,
            ]);

            $order->user->increment('balance_it_coin', $cashback_coins);
        }
    }
}
