<?php

namespace Database\Seeders;

use App\Models\CryptoCurrency;
use App\Repositories\Currency\Crypto;
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
            Crypto::put(
                $code, 
                $crypto['numericCode'], 
                $crypto['name'], 
                $crypto['minorUnits']
            );
        }
    }
}
