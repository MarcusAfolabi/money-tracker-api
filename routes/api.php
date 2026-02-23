<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

/**
 * User Routes
 */
// Requirement: Create a user account (no auth) 
Route::post('/users', [UserController::class, 'store']);

// Requirement: View user profile (all wallets & total balance)  
Route::get('/users/{user}', [UserController::class, 'show']);

/**
 * Wallet Routes
 */
// Requirement: Create one or more wallets for a specific user 
Route::post('/users/{user}/wallets', [WalletController::class, 'store']);

// Requirement: View a single wallet (balance & transactions)  
Route::get('/wallets/{wallet}', [WalletController::class, 'show']);

/**
 * Transaction Routes
 */
// Requirement: Add transactions (Income/Expense) to a wallet 
Route::post('/wallets/{wallet}/transactions', [TransactionController::class, 'store']);