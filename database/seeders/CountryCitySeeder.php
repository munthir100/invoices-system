<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Country;
use App\Models\City;

class CountryCitySeeder extends Seeder
{
    public function run()
    {
        // Read the JSON file
        $json = File::get(resource_path('views/countries_and_cities.json'));

        // Decode the JSON data
        $data = json_decode($json);

        // Seed the countries table
        foreach ($data->countries as $countryData) {
            Country::create([
                'name' => $countryData->name,
                'code' => $countryData->code,
            ]);
        }

        foreach ($data->cities as $cityData) {
            City::create([
                'name' => $cityData->name,
                'country_id' => $cityData->country_id,
            ]);
        }
    }
}
