<?php

namespace Database\Seeders;

use App\Models\CryptoCurrecy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CryptoCurrecySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(resource_path('data/cryptocurrencies.json')), JSON_OBJECT_AS_ARRAY);
        foreach ($data as $code => $name) {
            CryptoCurrecy::create([
                'code' => $code,
                'name' => $name
            ]);
        }
    }
}
