<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Document>
 */
class DcoumentFactory extends Factory
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
            'document_id' => Document::factory(),
            'document_name' => fake()->name(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
            'user_id' => User::factory(),
        
        ];
    }
}
