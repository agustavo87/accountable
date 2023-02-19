<?php

namespace Database\Factories;

use App\Models\{Account, Operation};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movement>
 */
class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'operation_id' => Operation::factory(),
            'account_id' => Account::factory(),
            'type' => $this->faker->boolean(),
            'amount' => $this->faker->randomFloat(2,1,2000),
            'note' => $this->faker->sentence()
        ];
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function empty()
    {
        return $this->state(function (array $attributes) {
            return [
                'operation_id' => null,
                'account_id' => null,
                'type' => 0,
                'amount' => 0,
                'note' => ''
            ];
        });
    }
}
