<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(StoreTransactionRequest $request, Wallet $wallet): JsonResponse
    {
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $wallet) {
            $transaction = $wallet->transactions()->create($validated);

            // Update Wallet Balance based on transaction type
            $validated['type'] === 'income'
                ? $wallet->increment('balance', $validated['amount'])
                : $wallet->decrement('balance', $validated['amount']);

            return $this->sendResponse($transaction, 'Transaction recorded successfully.', 201);
        });
    }
}
