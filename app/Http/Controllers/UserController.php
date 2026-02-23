<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // Create a user account 
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($validated);

        return $this->sendResponse(
            new UserResource($user),
            'User created successfully.',
            201
        );
    }

    // View profile (all wallets and total balance) 
    public function show(User $user): JsonResponse
    {
        $user->load('wallets'); // Eager load for performance

        return $this->sendResponse(
            new UserResource($user),
            'User profile retrieved successfully.'
        );
    }
}
