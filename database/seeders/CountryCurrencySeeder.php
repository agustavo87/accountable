<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ISOCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Country::all() as $country) {
            $currencies = ISOCurrency::where('country_name', strtoupper($country->common_name))->get();
            foreach ($currencies as $currency) {
                DB::table('country_iso_currency')->insert([
                    'country_code' => $country->alpha_code_2,
                    'iso_currency_code' => $currency->code,
                    'iso_currency_id' => $currency->id,
                ]);
            }
        }
    }
}
