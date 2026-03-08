<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Список всіх юзерів (адмін).
     */
    public function users()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Конкретний юзер (адмін).
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Оновити профіль поточного юзера.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|nullable|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|nullable|string|unique:users,phone,' . $user->id,
        ]);

        $user->update($validated);

        return new UserResource($user->fresh());
    }

    /**
     * Транзакції поточного юзера.
     */
    public function transactions(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return TransactionResource::collection($transactions);
    }

    /**
     * Зміна пароля поточного юзера.
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Поточний пароль невірний',
            ], 422);
        }

        $user->update([
            'password' => $request->password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Пароль успішно змінено',
        ]);
    }
}

