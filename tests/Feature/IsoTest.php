<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class IsoTest extends TestCase
{

    /** @test */
    public function test_countries_hydration()
    {
        $data = json_decode(File::get(resource_path('data/countries.json')), JSON_OBJECT_AS_ARRAY);
        dd($data[5]);
    }
}
