<?php

namespace Database\Seeders;

use App\Models\CryptoCurrency;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CryptoCurrencySeeder::class,
            JohnDoeSeeder::class,
            // ISOCurrencySeeder::class,
            // CountrySeeder::class,
            // CountryCurrencySeeder::class,
        ]);
    }
}
