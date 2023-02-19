<?php

namespace Database\Factories;

use App\Models\{OperationCategory, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operation>
 */
class OperationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => OperationCategory::factory(),
            'name' => $this->faker->word(),
            'notes' => $this->faker->sentence()
        ];
    }
}
