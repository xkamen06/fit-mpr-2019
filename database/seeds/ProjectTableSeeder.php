<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('project')->truncate();
        $faker = Factory::create();
        $users = DB::table('users')->get();
        $usersCount = count($users);

        for ($i = 0; $i < 100; $i++) {
            DB::table('project')->insert([
                'name' => $faker->word,
                'estimated_price' => rand(10000, 1000000),
                'estimated_time' => rand(50, 500),
                'date_from' => $faker->dateTimeBetween('-3 years','now'),
                'date_to' => $faker->dateTimeBetween('now','1 year'),
                'id_user' =>  $users[random_int(0, $usersCount - 1)]->id,
                'status' => array_random(['Aktivní', 'Krizové řízení', 'Dokončený']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
