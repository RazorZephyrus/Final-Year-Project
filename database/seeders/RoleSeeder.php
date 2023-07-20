<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Constants\RoleConst;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertRole();
    }

    private function insertRole()
    {
        $role = Role::create([
            'name' => RoleConst::SUPER_ADMIN,
        ]);

        $role->givePermissionTo(Permission::all());

        $roleSt = Role::create([
            'name' => RoleConst::STUDENT,
        ]);
        $roleSt->givePermissionTo(Permission::all());

        $roleStaff = Role::create([
            'name' => RoleConst::STAFF,
        ]);
        $roleStaff->givePermissionTo(Permission::all());
    }
}
