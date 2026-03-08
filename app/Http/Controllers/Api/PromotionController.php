<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::orderBy('valid_until', 'asc')->get();

        return PromotionResource::collection($promotions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'valid_until' => 'nullable|date|after:today',
        ]);

        $promotion = Promotion::create($validate);

        return new PromotionResource($promotion);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promotion = Promotion::findOrFail($id);

        return new PromotionResource($promotion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promotion = Promotion::findOrFail($id);

        $validate = $request->validate([
            'title' => 'sometimes|string|max:255',
            'image_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'valid_until' => 'nullable|date|after:today',
        ]);

        $promotion->update($validate);

        return new PromotionResource($promotion->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promotion = Promotion::findOrFail($id);

        $promotion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promotion deleted successfully',
        ]);
    }
}

