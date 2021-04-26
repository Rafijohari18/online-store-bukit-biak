<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use RafiJohari\RajaOngkir\Location;
use App\Models\Province;
use App\Models\City;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = Location::getProvinsi();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'province_id' => $provinceRow['province_id'],
                'name'        => $provinceRow['province'],
            ]);
            $daftarKota = Location::findkota($provinceRow['province_id']);
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'province_id'   => $provinceRow['province_id'],
                    'city_id'       => $cityRow['city_id'],
                    'name'          => $cityRow['city_name'],
                    'type'          => $cityRow['type'],
                ]);
            }
        }
    }
}
