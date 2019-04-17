<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testStorePOSTUser()
    {
        $data = [
            'name' => 'meno',
            'role' => 2,
            'email' => 'email@email.com',
            'password' => 'passfdgfdg',
        ];

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'uzivatele/ulozit', $data);

        $response->assertStatus(302);

    }

    public function testUpdatePOSTUser()
    {
		$id = DB::select("select max(id) as iden from users");

        $data = [
            'name' => 'meno8',
            'role' => 2,
            'password' => 'passfdgfdgkl',
        ];

        \Auth::login(User::find(1));

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'uzivatele/update/'.$id[0]->iden, $data);

        $response->assertStatus(302);

        User::destroy($id[0]->iden);

    }
}
