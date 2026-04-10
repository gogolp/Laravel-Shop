<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Зберегти відгук від користувача сайту.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        $feedback = Feedback::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Дякуємо за ваш відгук!',
            'data' => [
                'id' => $feedback->id,
                'created_at' => $feedback->created_at->format('d.m.Y H:i'),
            ],
        ], 201);
    }
}
