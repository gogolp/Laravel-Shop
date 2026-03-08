<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPointsRequest;
use App\Service\LoyaltyService;

class LoyaltyController extends Controller
{
    public function __construct(
        private LoyaltyService $loyaltyService,
    ) {
    }

    public function addPoints(AddPointsRequest $request)
    {
        $this->loyaltyService->addPoints($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Add points success',
            'balance' => $this->loyaltyService->getBalance($request->validated('user_id')),
        ]);
    }

    public function redeemPoints(AddPointsRequest $request)
    {
        $this->loyaltyService->redeemPoints($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Points redeemed successfully',
            'balance' => $this->loyaltyService->getBalance($request->validated('user_id')),
        ]);
    }

    public function balance(string $id)
    {
        $balance = $this->loyaltyService->getBalance($id);

        return response()->json([
            'user_id' => $id,
            'balance_it_coin' => $balance,
        ]);
    }
}

