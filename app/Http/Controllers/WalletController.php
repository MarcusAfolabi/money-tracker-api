<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    // Create one or more wallets for a user 
    public function store(StoreWalletRequest $request, User $user): JsonResponse
    {
        $wallet = $user->wallets()->create($request->validated());

        return $this->sendResponse(new WalletResource($wallet), 'Wallet created successfully.', 201);
    }

    //Select a single wallet to view balance and transactions 
    public function show(Wallet $wallet): JsonResponse
    {
        // We load transactions
        $wallet->load('transactions');

        return $this->sendResponse(
            [
                'wallet' => new WalletResource($wallet),
                'transactions' => $wallet->transactions
            ],
            'Wallet details retrieved successfully.'
        );
    }
}
