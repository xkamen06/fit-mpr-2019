<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $faker = Factory::create();

        DB::table('users')->insert([
            'name' => 'admin',
            'id_role_enum' => 1,
            'email' => 'admin@admin.cz',
            'password' => bcrypt('admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        for ($i = 0; $i < 50; $i++) {
            $name = $faker->lastName;
            DB::table('users')->insert([
                'name' => $name,
                'id_role_enum' => rand(2, 3),
                'email' => $name . rand(1, 100). '@mpr.cz',
                'password' => bcrypt('secret'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
