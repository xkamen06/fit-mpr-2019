<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    public function testCreateProject()
    {
        $data = [
        	'id' => 99,
            'name' => 'meno',
            'id_user' => 2,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'status' => 'stav',
        ];

        $project = (new Project)->create($data);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals($data['name'], $project->name);
        $this->assertEquals($data['id_user'], $project->id_user);
        $this->assertEquals($data['estimated_price'], $project->estimated_price);
        $this->assertEquals($data['estimated_time'], $project->estimated_time);
        $this->assertEquals($data['date_from'], $project->date_from);
        $this->assertEquals($data['date_to'], $project->date_to);
        $this->assertEquals($data['status'], $project->status);

    }

    public function testGetProject()
    {
        $data = [
        	'id' => 99,
            'name' => 'meno',
            'id_user' => 2,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'status' => 'stav',
        ];

        $found = (new Project)->findOrFail(99);

        $this->assertInstanceOf(Project::class, $found);
        $this->assertEquals($data['name'], $found->name);
        $this->assertEquals($data['id_user'], $found->id_user);
        $this->assertEquals($data['estimated_price'], $found->estimated_price);
        $this->assertEquals($data['estimated_time'], $found->estimated_time);
        $this->assertEquals($data['date_from'], $found->date_from);
        $this->assertEquals($data['date_to'], $found->date_to);
        $this->assertEquals($data['status'], $found->status);
    }

    public function testUpdateProject()
    {
        $data = [
        	'id' => 99,
            'name' => 'meno',
            'id_user' => 6,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'status' => 'stav',
        ];

        Project::where('id', 99)
          ->update(['id_user' => 6]);

        $found = (new Project)->findOrFail(99);

        $this->assertInstanceOf(Project::class, $found);
        $this->assertEquals($data['name'], $found->name);
        $this->assertEquals($data['id_user'], $found->id_user);
        $this->assertEquals($data['estimated_price'], $found->estimated_price);
        $this->assertEquals($data['estimated_time'], $found->estimated_time);
        $this->assertEquals($data['date_from'], $found->date_from);
        $this->assertEquals($data['date_to'], $found->date_to);
        $this->assertEquals($data['status'], $found->status);
    }

    public function testDeleteProject()
    {
        Project::destroy(99);
        $found = (new Project)->find(99);
        $this->assertEquals($found, null);
    }

    public function testStorePOSTProject()
    {
        $data = [
            'name' => 'meno',
            'manager' => 2,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
        ];

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'projekty/ulozit', $data);

        $response->assertStatus(302);

        \DB::table("project")
        ->where("id_user", "=", "2")
        ->orderBy("id", "DESC")
        ->take(1)
        ->delete();

    }

    public function testUpdatePOSTProject()
    {
        $data2 = [
            'id' => 98,
            'name' => 'meno',
            'id_user' => 2,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'status' => 'stav',
        ];

        (new Project)->create($data2);

        $data = [
            'name' => 'meno',
            'manager' => 8,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
        ];

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'projekty/update/98', $data);

        $response->assertStatus(302);

        \DB::table("phase")
        ->where("id_project", ">", "98")
        ->delete();
        Project::destroy(98);

    }

    public function testUpdateStatusPOSTProject()
    {
        $data2 = [
            'id' => 98,
            'name' => 'meno',
            'id_user' => 2,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'status' => 'stav',
        ];

        (new Project)->create($data2);

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'projekty/status/update/98', ['status' => 'Dokončený']);

        $response->assertStatus(302);

        Project::destroy(98);
    }
}
