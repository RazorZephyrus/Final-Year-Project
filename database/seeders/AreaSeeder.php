<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertCountry();
        $this->insertProvince();
        $this->insertCity();
        $this->insertSuburb();
        $this->insertAreas();
    }

    private function insertCountry(){
        DB::table('countries')->insert([
            [
                'id' => 288, 
                'uuid' => Uuid::uuid4()->toString(),
                'title' => 'Indonesia',
                'code' => 'ID',
                'phone_code' => 62
            ]
        ]);
    }

    private function insertProvince()
    {
        $file = json_decode(file_get_contents(__DIR__."/Json/Province.json"));
        $newData = [];
        foreach($file->data as $item) {
            $newData[] = [
                'id' => $item->id,
                'uuid' => Uuid::uuid4()->toString(),
                'title' => $item->name,
                'country_id' => 288
            ];
        }

        DB::table('provinces')->insert($newData);
    }

    private function insertCity()
    {
        $file = json_decode(file_get_contents(__DIR__."/Json/City.json"));
        $newData = [];

        foreach($file->data as $item) {
            $newData[] = [
                'id' => $item->id,
                'uuid' => Uuid::uuid4()->toString(),
                'title' => $item->name,
                'province_id' => $item->province->id
            ];
        }

        DB::table('cities')->insert($newData);
    }

    private function insertSuburb()
    {
        $newData = [];

        for($i = 1; $i <= 15; $i++) {
            $file = json_decode(file_get_contents(__DIR__."/Json/Suburb/Suburb".$i.".json"));
            foreach($file->data as $item) {
                $newData[] = [
                    'id' => $item->id,
                    'uuid' => Uuid::uuid4()->toString(),
                    'title' => $item->name,
                    'city_id' => $item->city->id
                ];
            }
        }

        DB::table('suburbs')->insert($newData);
    }

    private function insertAreas()
    {
        $newData = [];
        $memory = ini_get('memory_limit');
        ini_set('memory_limit','512M');

        for($i = 1; $i <= 82; $i++) {
            $file = json_decode(file_get_contents(__DIR__."/Json/Area/Area".$i.".json"));
            foreach($file->data as $item) {
                $newData[] = [
                    'id' => $item->id,
                    'uuid' => Uuid::uuid4()->toString(),
                    'title' => $item->name,
                    'postcode' => $item->postcode,
                    'suburb_id' => $item->suburb->id,
                ];

                if(count($newData) == 1000) {
                    DB::table('areas')->insert($newData);
                    $newData = [];
                }
            }
        }

        DB::table('areas')->insert($newData);
        ini_set('memory_limit', $memory);
    }
}
