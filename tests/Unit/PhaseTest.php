<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Phase;
use App\User;
use App\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

//class testing Phase module for CRUD and POST requests
class PhaseTest extends TestCase
{
    public function testCreatePhase()
    {
        $data = [
        	'id' => 99,
            'id_project' => 1,
            'id_user' => 2,
            'id_phase_enum' => 3,
            'description' => 'popis',
            'price' => 50,
            'spent_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'state' => 'stav',
        ];

        $phase = (new Phase)->create($data);

        $this->assertInstanceOf(Phase::class, $phase);
        $this->assertEquals($data['id_project'], $phase->id_project);
        $this->assertEquals($data['id_user'], $phase->id_user);
        $this->assertEquals($data['id_phase_enum'], $phase->id_phase_enum);
        $this->assertEquals($data['description'], $phase->description);
        $this->assertEquals($data['price'], $phase->price);
        $this->assertEquals($data['spent_time'], $phase->spent_time);
        $this->assertEquals($data['date_from'], $phase->date_from);
        $this->assertEquals($data['date_to'], $phase->date_to);
        $this->assertEquals($data['state'], $phase->state);

    }

    public function testGetPhase()
    {
        $data = [
        	'id' => 99,
            'id_project' => 1,
            'id_user' => 2,
            'id_phase_enum' => 3,
            'description' => 'popis',
            'price' => 50,
            'spent_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'state' => 'stav',
        ];

        $found = (new Phase)->findOrFail(99);

        $this->assertInstanceOf(Phase::class, $found);
        $this->assertEquals($data['id_project'], $found->id_project);
        $this->assertEquals($data['id_user'], $found->id_user);
        $this->assertEquals($data['id_phase_enum'], $found->id_phase_enum);
        $this->assertEquals($data['description'], $found->description);
        $this->assertEquals($data['price'], $found->price);
        $this->assertEquals($data['spent_time'], $found->spent_time);
        $this->assertEquals($data['date_from'], $found->date_from);
        $this->assertEquals($data['date_to'], $found->date_to);
        $this->assertEquals($data['state'], $found->state);
    }

    public function testUpdatePhase()
    {
        $data = [
        	'id' => 99,
            'id_project' => 1,
            'id_user' => 6,
            'id_phase_enum' => 3,
            'description' => 'popis',
            'price' => 50,
            'spent_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'state' => 'stav',
        ];

        Phase::where('id', 99)
          ->update(['id_user' => 6]);

        $found = (new Phase)->findOrFail(99);

        $this->assertInstanceOf(Phase::class, $found);
        $this->assertEquals($data['id_project'], $found->id_project);
        $this->assertEquals($data['id_user'], $found->id_user);
        $this->assertEquals($data['id_phase_enum'], $found->id_phase_enum);
        $this->assertEquals($data['description'], $found->description);
        $this->assertEquals($data['price'], $found->price);
        $this->assertEquals($data['spent_time'], $found->spent_time);
        $this->assertEquals($data['date_from'], $found->date_from);
        $this->assertEquals($data['date_to'], $found->date_to);
        $this->assertEquals($data['state'], $found->state);
    }

    public function testDeletePhase()
    {
        Phase::destroy(99);
        $found = (new Phase)->find(99);
        $this->assertEquals($found, null);
    }

    public function testUpdatePOSTPhase()
    {
        $data2 = [
            'id' => 999,
            'id_project' => 1,
            'id_user' => 2,
            'id_phase_enum' => 3,
            'description' => 'popis',
            'price' => 50,
            'spent_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'state' => 'stav',
        ];

        $phase = (new Phase)->create($data2);

        $data = [
            'manager' => 8,
            'description' => 'popis',
            'price' => 50,
            'spent_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'state' => 'stav',
        ];

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'projekty/faze/update/999', $data);

        $response->assertStatus(302);

        Phase::destroy(999);
    }

    public function testZmenitPOSTPhase()
    {
        $data = [
            'id' => 199,
            'name' => 'meno',
            'id_user' => 2,
            'estimated_price' => 50,
            'estimated_time' => 5,
            'date_from' => '2019-04-16',
            'date_to' => '2019-04-18',
            'status' => 'stav',
        ];

        $project = (new Project)->create($data);

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'projekty/faze/zmenit/199', ['phase' => 5]);

        $response->assertStatus(302);

        Project::destroy(199);
    }
}
