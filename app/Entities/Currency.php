<?php

namespace App\Entities;

readonly class Currency
{
    public function __construct(
        readonly public string $code,
        readonly public string $name,
        readonly public ?string $countryCode = null
    ) {}
}