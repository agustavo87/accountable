<?php

namespace Database\Seeders;

use App\Models\ISOCurrency;
use Brick\Money\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use PragmaRX\Countries\Package\Countries;

class ISOCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voidcomposer require pragmarx/countries
     */
    public function run()
    {
        foreach (Countries::currencies()->all() as $currency) {
            try {
                ISOCurrency::create([
                    'code' => $currency->iso->code,
                    'number' => $currency->iso->number,
                    'name'  => $currency->name,
                    'minor_units' => $this->getCurrencyMinorUnits($currency->iso->code),
                    'symbol' => $this->getSymbol($currency->units->major->symbol) ?? '$',
                ]);
            } catch (\Throwable $th) {
                echo $th->getMessage() . "\n";
                echo $th->getTraceAsString() . "\n";

                print_r($currency->iso->code);
                print_r($currency);
            }
           
        }
    }

    protected function getCurrencyMinorUnits($code) {
        try {
            return Currency::of($code)->getDefaultFractionDigits();
        } catch (\Throwable $th) {
            Log::error('Problem when obtening currency minor units', [
                'code' => $code,
                'message' => $th->getMessage()
            ]);
            return 2;
        }
    }

    protected function getSymbol($symbol): string
    {
        $symbol = trim(explode(', ', $symbol)[0]);
        $symbol = trim(explode(' or ', $symbol)[0]);
        return strlen($symbol) ? $symbol : '$';
    }
}
