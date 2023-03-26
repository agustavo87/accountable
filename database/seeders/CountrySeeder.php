<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(resource_path('data/countries.json')), JSON_OBJECT_AS_ARRAY);

        foreach ($data as $country) {
            Country::create([
                'alpha_code_2' => $country['cca2'],
                'alpha_code_3' => $country['cca3'],
                'numeric_code_3' => $country['ccn3'],
                'common_name' => $country['name']['common'],
                'oficial_name' => $country['name']['official'],
                'native_names' => $country['name']['native'],
                'currencies' => $country['currencies'],
            ]);
        }
    }
}
