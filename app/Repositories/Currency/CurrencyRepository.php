<?php

namespace App\Repositories\Currency;

use App\Values\Currency;
use App\Values\CurrencyType;
use App\Values\EnhancedCurrency;
use App\Values\WrappedBrickCurrency;

interface CurrencyRepository
{
    /**
     * Get Currency by Number
     *
     * @param integer $code
     * @throws \App\Exceptions\CurrencyNotFoundException
     * @return Currency
     */
    public function getByNumber(int $code): EnhancedCurrency;

    /**
     * Get Currency by Code
     *
     * @param string $code
     * @throws \App\Exceptions\CurrencyNotFoundException
     * @return Currency
     */
    public function get(string $code): EnhancedCurrency;

    public function getType(): CurrencyType;
}