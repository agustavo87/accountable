<?php

namespace Database\Seeders;

use App\Models\ISOCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ISOCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = simplexml_load_file(resource_path('data/iso4217_2023_01_01.xml'));
        foreach ($data->CcyTbl->CcyNtry as $element) {
            ISOCurrency::create([
                'code' => $element->Ccy,
                'number' => $element->CcyNbr,
                'name' => $element->CcyNm,
                'minor_units' => (int)$element->CcyMnrUnts,
                'country_name' => $element->CtryNm,
            ]);
        }
    }
}
