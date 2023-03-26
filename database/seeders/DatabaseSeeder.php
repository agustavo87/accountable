<?php

namespace Database\Seeders;

use App\Models\CryptoCurrecy;
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
            ISOCurrencySeeder::class,
            CryptoCurrecySeeder::class,
            CountrySeeder::class,
            CountryCurrencySeeder::class,
        ]);
    }
}
