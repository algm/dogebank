<?php

namespace Tests\Feature\Branches;

use Tests\Shared\Infrastructure\ApiTestCase;

class ListBranchesTest extends ApiTestCase
{
    public function testListsAllBranchesWithTheirMaximumBalance()
    {
        $this->generateSavedBranches(10);

        $this->json('get', '/api/branches')
            ->assertOk()
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'location',
                        'maxBalance',
                    ],
                ],
            ]);
    }
}
