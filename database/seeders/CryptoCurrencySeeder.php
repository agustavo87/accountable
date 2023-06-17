<?php

namespace Database\Seeders;

use App\Models\CryptoCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CryptoCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = require resource_path('data/cryptos.php');
        foreach ($data as $code => $crypto) {
            CryptoCurrency::create([
                'code' => $code,
                'name' => $crypto['name'],
                'numeric_code'=> $crypto['numericCode'],
                'minor_units'=> $crypto['minorUnits'],
            ]);
        }
    }
}
