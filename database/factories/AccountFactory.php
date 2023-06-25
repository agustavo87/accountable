<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Facades\Money;
use App\Values\Money as MoneyI;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $code = $this->faker->randomElement(['USD', 'EUR', 'ARS', 'MXN']);
        $balance = $this->faker->randomFloat(2,-12000,40000);
        $money = Money::of("$balance", $code);
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'currency' => $code,
            'balance' => $balance,
            'balance_amount' => $money->getMinorAmount(),
            'balance_currency_number' => $money->getCurrencyNumber(),
            'balance_currency_type' => $money->getCurrencyType()->value
        ];
    }

    public function withBalance($amount, $currencyCode)
    {
        $money = Money::of($amount, $currencyCode);
        
        return $this->state(function ($attributes) use( $money) {
            return [
                'balance' => $money->getDecimalAmount(),
                'balance_amount' => $money->getMinorAmount(),
                'balance_currency_number' => $money->getCurrencyNumber(),
                'balance_currency_type' => $money->getCurrencyType()->value
            ];
        });
    }
}
