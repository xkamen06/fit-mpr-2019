<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PhaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('phase')->truncate();
        $faker = Factory::create();
        $users = DB::table('users')->get();
        $usersCount = count($users);
        $projects = DB::table('project')->get();
        foreach ($projects as $project) {
            $randomPhase = rand(1, 10);
            for ($i = 1; $i <= 10; $i++) {
                if ($project->status === 'Dokončený') {
                    $state = 'Dokončený';
                } else {
                    if ($i < $randomPhase) {
                        $state = 'Dokončený';
                    } elseif ($i === $randomPhase) {
                        $state = 'V řešení';
                    } else {
                        $state = 'Nedokončený';
                    }
                }
                DB::table('phase')->insert([
                    'id_project' => $project->id,
                    'id_user' =>  $users[random_int(0, $usersCount - 1)]->id,
                    'id_phase_enum' => $i,
                    'description' => $faker->paragraph,
                    'price' => rand(1000, 3000),
                    'spent_time' => rand(10, 30),
                    'date_from' => $faker->dateTimeBetween('-3 years','now'),
                    'date_to' => $faker->dateTimeBetween('now','1 year'),
                    'state' =>  $state,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}