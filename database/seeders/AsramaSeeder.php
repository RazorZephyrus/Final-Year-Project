<?php

namespace Database\Seeders;

use App\Models\Asramas;
use App\Models\Fasilitas;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('asrama')->truncate();
        DB::table('fasilitas')->truncate();
        DB::table('room')->truncate();
        DB::table('room_fasilitas')->truncate();
        DB::table('room_type')->truncate();
        $asrama = ['Asrama Gedung A', 'Asrama Gedung B', 'Asrama Gedung C', 'Asrama Gedung D'];
        $fasilitas = ['AC', 'WIFI', "Meja", 'Lemari', "Kasur", "Smoking Area", "Breakfast", "Morning Snack", "Televisi", "Loundry", "Kamar Mandi Dalam"];
        foreach ($asrama as $key => $value) {
            Asramas::create([
                'title' => $value,
                'description' => $value,
                'lokasi' => null
            ]);
        }

        foreach ($fasilitas as $key => $value) {
            Fasilitas::create([
                'title' => $value,
                'description' => $value,
            ]);
        }

        $type = ["Standard", "Single", "Double", "Deluxe", "Suite", "Family"];
        foreach ($type as $key => $value) {
            RoomType::create([
                'title' => $value,
                'description' => $value,
            ]);
        }
    }
}
