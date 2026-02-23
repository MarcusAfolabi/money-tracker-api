<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('full money tracker workflow meets all requirements', function () {

    // 1. Requirement: Create a user account
    $userResponse = $this->postJson('/api/v1/users', [
        'name'  => 'Abiodun',
        'email' => 'abiodun@example.com'
    ])->assertStatus(201);

    $userId = $userResponse->json('data.id');

    // 2. Requirement: Create one or more wallets
    $this->postJson("/api/v1/users/{$userId}/wallets", ['name' => 'Main Wallet'])->assertStatus(201);
    $wallet2 = $this->postJson("/api/v1/users/{$userId}/wallets", ['name' => 'Savings Wallet'])->assertStatus(201);

    $walletId = $wallet2->json('data.id');

    // 3. Requirement: Add transactions (Income / Expense)
    // Add Income (+1000)
    $this->postJson("/api/v1/wallets/{$walletId}/transactions", [
        'amount' => 1000,
        'type'   => 'income',
        'description' => 'Freelance Work'
    ])->assertStatus(201);

    // Add Expense (-400)
    $this->postJson("/api/v1/wallets/{$walletId}/transactions", [
        'amount' => 400,
        'type'   => 'expense',
        'description' => 'Dinner'
    ])->assertStatus(201);

    // 4. Requirement: View Profile (All wallets, each balance, total balance)
    $profileResponse = $this->getJson("/api/v1/users/{$userId}")
        ->assertStatus(200);

    // Using assertEquals to handle both 600 and "600.00"
    expect($profileResponse->json('data.total_balance'))->toEqual(600);
    $profileResponse->assertJsonCount(2, 'data.wallets');

    // 5. Requirement: View single wallet (Balance + Transactions)
    $walletResponse = $this->getJson("/api/v1/wallets/{$walletId}")
        ->assertStatus(200);

    expect($walletResponse->json('data.wallet.balance'))->toEqual(600);
    $walletResponse->assertJsonCount(2, 'data.transactions');
});

test('validation prevents negative amounts and invalid types', function () {
    // Create user and wallet manually for validation test
    $user = User::create(['name' => 'Test', 'email' => 'test@test.com']);
    $wallet = $user->wallets()->create(['name' => 'Test Wallet']);

    $this->postJson("/api/v1/wallets/{$wallet->id}/transactions", [
        'amount' => -50,
        'type'   => 'invalid_type'
    ])->assertStatus(422)
        ->assertJsonValidationErrors(['amount', 'type']);
});
