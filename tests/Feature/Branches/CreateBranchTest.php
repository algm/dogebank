<?php

namespace Tests\Feature\Branches;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\Shared\Infrastructure\ApiTestCase;

class CreateBranchTest extends ApiTestCase
{
    use WithFaker;

    public function testCanCreateValidBranches()
    {
        $city = $this->faker->unique()->city;
        $id = Str::uuid()->toString();

        $this->json('post', '/api/branches', [
           'id' => $id,
           'location' => $city,
       ])
           ->assertOk()
           ->assertJson([
               'data' => [
                   'id' => $id,
                   'location' => $city,
               ],
           ]);
    }
}
