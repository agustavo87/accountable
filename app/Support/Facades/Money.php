<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \App\Values\MoneyFactory
 */
class Money extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'money';
    }
}
