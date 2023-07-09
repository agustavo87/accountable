<?php

namespace Database\Factories;

use App\Models\{Account, Movement, Operation};
use App\Support\Facades\Money;
use App\Values\CurrencyType;
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
        $code = $this->faker->randomElement(['USD', 'EUR', 'ARS', 'MXN']);
        $amount = $this->faker->randomFloat(2,1,1000);
        $money = Money::of("$amount", $code);
        
        return [
            'operation_id' => Operation::factory(),
            'account_id' => Account::factory()->state([
                'balance_currency_number' => $money->getCurrencyNumber(),
                'balance_currency_type' => $money->getCurrencyType()->value
            ]),
            'type' => $this->faker->boolean(),
            'minor_amount' => $money->getMinorAmount(),
            'currency_number' => $money->getCurrencyNumber(),
            'currency_type' => $money->getCurrencyType()->value,
            'note' => $this->faker->sentence()
        ];
    }

    public function withAmount($amount, $currencyCode)
    {
        $money = Money::of($amount, $currencyCode);
        
        return $this->state(function ($attributes) use( $money) {
            return [
                'minor_amount' => $money->getMinorAmount(),
                'currency_number' => $money->getCurrencyNumber(),
                'currency_type' => $money->getCurrencyType()->value
            ];
        });
    }

    public function empty()
    {
        return $this->state(function (array $attributes) {
            return [
                'operation_id' => null,
                'account_id' => null,
                'type' => 0,
                'minor_amount' => 0,
                'currency_number' => 32,
                'currency_type' => CurrencyType::Fiat->value,
                'note' => ''
            ];
        });
    }
}
