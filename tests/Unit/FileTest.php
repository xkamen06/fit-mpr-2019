<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\File;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
{
    public function testCreateFile()
    {
        $data = [
        	'id' => 99,
            'name' => 'nieco',
            'path' => 'path1',
            'id_phase' => 2,
        ];

        $file = (new File)->create($data);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals($data['name'], $file->name);
        $this->assertEquals($data['path'], $file->path);
        $this->assertEquals($data['id_phase'], $file->id_phase);

    }

    public function testGetFile()
    {
        $data = [
            'name' => 'nieco',
            'path' => 'path1',
            'id_phase' => 2,
        ];

        $found = (new File)->findOrFail(99);

        $this->assertInstanceOf(File::class, $found);
        $this->assertEquals($found->name, $data['name']);
        $this->assertEquals($found->path, $data['path']);
        $this->assertEquals($found->id_phase, $data['id_phase']);
    }

    public function testUpdateFile()
    {
        $data = [
            'name' => 'nieco',
            'path' => 'path1',
            'id_phase' => 6,
        ];

        File::where('id', 99)
          ->update(['id_phase' => 6]);

        $found = (new File)->findOrFail(99);

        $this->assertInstanceOf(File::class, $found);
        $this->assertEquals($found->name, $data['name']);
        $this->assertEquals($found->path, $data['path']);
        $this->assertEquals($found->id_phase, $data['id_phase']);
    }

    public function testDeleteFile()
    {
        File::destroy(99);
        $found = (new File)->find(99);
        $this->assertEquals($found, null);
    }
}
