<?php

namespace Database\Factories;

use App\Models\creditsAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<creditsAccount>
 */
class creditsAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'credit_id' => creditsAccount::factory(),
            'amount' => fake()->randomFloat(2, 0, 1000),
            'user_id' => user::factory(),
        ];
    }
}
