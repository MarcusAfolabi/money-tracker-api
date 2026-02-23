<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // Create a user account 
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return $this->sendResponse(new UserResource($user), 'User created successfully.', 201);
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
