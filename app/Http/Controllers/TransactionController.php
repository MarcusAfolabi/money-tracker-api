<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
class TransactionController extends Controller
{
    public function store(Request $request, Wallet $wallet): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01', // Positive amounts 
            'type' => 'required|in:income,expense',  // Valid transaction type 
            'description' => 'nullable|string|max:255',
        ]);

        // Use a Database Transaction to ensure data integrity 
        return DB::transaction(function () use ($validated, $wallet) {
            
            $transaction = $wallet->transactions()->create($validated);

            // Update Wallet Balance 
            if ($validated['type'] === 'income') {
                $wallet->increment('balance', $validated['amount']);
            } else {
                $wallet->decrement('balance', $validated['amount']);
            }

            return $this->sendResponse(
                $transaction, 
                'Transaction recorded and wallet balance updated.', 
                201
            );
        });
    }
}
