<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Note;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    public function testCreateNote()
    {
        $data = [
        	'id' => 99,
            'content' => 'nieco',
            'id_project' => 1,
            'id_user' => 2,
        ];

        $note = (new Note)->create($data);

        $this->assertInstanceOf(Note::class, $note);
        $this->assertEquals($data['content'], $note->content);
        $this->assertEquals($data['id_project'], $note->id_project);
        $this->assertEquals($data['id_user'], $note->id_user);

    }

    public function testGetNote()
    {
        $data = [
            'content' => 'nieco',
            'id_project' => 1,
            'id_user' => 2,
        ];

        $found = (new Note)->findOrFail(99);

        $this->assertInstanceOf(Note::class, $found);
        $this->assertEquals($found->content, $data['content']);
        $this->assertEquals($found->id_project, $data['id_project']);
        $this->assertEquals($found->id_user, $data['id_user']);
    }

    public function testUpdateNote()
    {
        $data = [
            'content' => 'nieco',
            'id_project' => 1,
            'id_user' => 6,
        ];

        Note::where('id', 99)
          ->update(['id_user' => 6]);

        $found = (new Note)->findOrFail(99);

        $this->assertInstanceOf(Note::class, $found);
        $this->assertEquals($found->content, $data['content']);
        $this->assertEquals($found->id_project, $data['id_project']);
        $this->assertEquals($found->id_user, $data['id_user']);
    }

    public function testDeleteNote()
    {
        Note::destroy(99);
        $found = (new Note)->find(99);
        $this->assertEquals($found, null);
    }
}
