<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Document;
use App\Models\creditsAccount;
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
        // Create 10 users
        $users = User::factory(10)->create();

        // Create 10 documents and assign each to a random user
        Document::factory(10)->create()->each(function ($document) use ($users) {
            $document->user_id = $users->random()->user_id;
            $document->save();
        });

        // Associate a user with an account
        $users->each(function ($user) {

            // Create an account for the user
            $account = Account::factory()->create([
                'user_id' => $user->user_id,
            ]);

            // Create a credits account with 100 credits
            $creditsAccount = creditsAccount::factory()->create([
                'amount' => 100,
            ]);

            // Associate the account with the credits account
            $account->account_id = $creditsAccount->credit_id;
            $account->save();
        });
    }
}