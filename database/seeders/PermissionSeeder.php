<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Constants\PermissionConst;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertPermission();
    }

    private function insertPermission()
    {
        $permissions = [
            [PermissionConst::MENU_USER, 'admin'],
            [PermissionConst::MENU_REWARD, 'admin'],
            [PermissionConst::MENU_ABSENSI, 'admin'],
            [PermissionConst::MENU_BILLING, 'admin'],
            [PermissionConst::MENU_REPORT, 'admin'],
        ];

        foreach ($permissions as $item) {
            Permission::create([
                'name' => $item[0],
                // 'title' => ucwords(str_replace('-',' ', $item[0])),
                // 'group' => $item[1]
            ]);
        }
    }
}
