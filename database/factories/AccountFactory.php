<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\creditsAccount;
use App\Models\Document;
use App\Models\Account;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'account_id' => Account::factory(),
            'email' => fake()->email(),
            'password' => fake()->password(6, 11),
            'created_at' => Str('created_at'),
            'updated_at' => Str('updated_at'),
            'user_id' => User::factory(),
            'credit_id' => creditsAccount::factory(),
            'document_id' => Document::factory(),
        ];
    }
}
