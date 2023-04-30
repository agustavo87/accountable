<?php

namespace App\Contracts;

use App\Entities\Currency;

interface CurrencyRepository
{
    /**
     * @return Currency[]
     */
    public function getAll(): array;
}