<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

Route::prefix('v1')->group(function () {

    /**
     * User Routes
     */
    // Requirement: Create a user account 
    Route::post('/users', [UserController::class, 'store']);

    // Requirement: View user profile with all wallets and total balance 
    Route::get('/users/{user}', [UserController::class, 'show']);

    /**
     * Wallet Routes
     */
    // Requirement: Create one or more wallets for a user 
    Route::post('/users/{user}/wallets', [WalletController::class, 'store']);

    // Requirement: Select a single wallet to view balance and transactions 
    Route::get('/wallets/{wallet}', [WalletController::class, 'show']);

    /**
     * Transaction Routes
     */
    // Requirement: Add transactions (Income/Expense) to a wallet 
    Route::post('/wallets/{wallet}/transactions', [TransactionController::class, 'store']);

});