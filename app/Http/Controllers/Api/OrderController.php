<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Service\OrderService;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('items.product', 'location')
            ->where('user_id', request()->user()->id)
            ->latest()
            ->get();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $this->orderService->create($request->validated(), $request->user());

        return response()->json([
            'status' => 'success',
            'message' => 'Order created!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('items.product', 'location')->findOrFail($id);

        Gate::authorize('view', $order);

        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);

        Gate::authorize('update', $order);

        $this->orderService->update($order, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Order updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        Gate::authorize('delete', $order);

        $this->orderService->delete($order);

        return response()->json([
            'status' => 'success',
            'message' => 'Order deleted!',
        ]);
    }
}
