<?php

namespace Database\Seeders;

use App\Constants\RoleConst;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Students;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['Admin', 'admin@gmail.com', 'admin', RoleConst::SUPER_ADMIN],
            ['Student', 'student@gmail.com', 'student', RoleConst::STUDENT],
        ];

        $gender = ['L', 'P'];
        foreach ($records as $item) {
            $this->create($item, $gender);
        }

        for ($i = 0; $i < 30; $i++) {
            $this->create([], $gender);
        }
    }

    private function create($item, $gender)
    {
        $faker = \Faker\Factory::create();
        $user = User::create([
            'name' => $item[0] ?? $faker->name,
            'email' => $item[1] ?? $faker->unique()->safeEmail,
            'username' => $item[2] ?? $faker->unique()->userName,
            'is_enabled' => 1,
            'password' => bcrypt('password'),
        ]);

        $role = $item[3] ?? RoleConst::STUDENT;
        $user->assignRole($role);
        if ($role == RoleConst::STUDENT) {
            Students::create([
                "user_id" => $user->id,
                "nik" => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
                "name" => $item[0] ?? $faker->name,
                "gender" => $gender[rand(0, 1)],
                "phone" => $faker->phoneNumber,
                "pob" => $faker->address,
                "dob" => $faker->dateTimeBetween('-30 years', '-20 years')->format('Y-m-d'),
            ]);
        }
    }
}
