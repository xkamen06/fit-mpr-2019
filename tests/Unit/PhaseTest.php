<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Phase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
            'date_from' => '2019-04-16 14:14:17',
            'date_to' => '2019-04-18 14:14:17',
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
            'date_from' => '2019-04-16 14:14:17',
            'date_to' => '2019-04-18 14:14:17',
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
            'date_from' => '2019-04-16 14:14:17',
            'date_to' => '2019-04-18 14:14:17',
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
}
