<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Settings::create([
            'slug' => Settings::POINT_ABSEN_SLUG,
            'name' => "Point Absence",
            'value' => 10000
            ]);
        Settings::create([
            'slug' => Settings::POINT_FEE_SLUG,
            'name' => "Point Fee Lembur",
            'value' => 50000
        ]);
    }
}
