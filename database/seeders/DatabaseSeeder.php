<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // 1. Create a specific test user
        $user = User::factory()->create([
            'name' => 'Abiodun Test',
            'email' => 'test@example.com',
        ]);

        // 2. Create multiple wallets for this user 
        Wallet::factory()->count(3)->create([
            'user_id' => $user->id
        ]);

        // Create 5 more random users with 1 wallet each
        User::factory(5)->create()->each(function ($u) {
            $u->wallets()->save(Wallet::factory()->make());
        });
    }
}
