<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('note')->truncate();
        $faker = Factory::create();
        $users = DB::table('users')->get();
        $usersCount = count($users);
        $projects = DB::table('project')->get();
        $projectsCount = count($projects);
        for ($i = 0; $i < 10000; $i++) {
            DB::table('note')->insert([
                'content' => $faker->sentence,
                'id_user' =>  $users[random_int(0, $usersCount - 1)]->id,
                'id_project' => $projects[random_int(0, $projectsCount - 1)]->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}