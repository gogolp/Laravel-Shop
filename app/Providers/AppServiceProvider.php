<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Listeners\ProcessOrderCashback;
use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(OrderPlaced::class, ProcessOrderCashback::class);

        Gate::policy(Order::class, OrderPolicy::class);
    }
}
