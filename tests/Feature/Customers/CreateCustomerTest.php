<?php

namespace Tests\Feature\Customers;

use Dogebank\Branches\Domain\BranchesRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\Branches\Domain\BranchIdMother;
use Tests\Branches\Domain\BranchMother;
use Tests\Shared\Infrastructure\ApiTestCase;

class CreateCustomerTest extends ApiTestCase
{
    use WithFaker;

    public function testCanCreateValidCustomers()
    {
        $branch = $this->generateSavedBranch();
        $branchId = $branch->getId();

        $this->mock(BranchesRepository::class, function (MockInterface $mock) use ($branchId) {
            $mock->shouldReceive('find')
                ->andReturn(BranchMother::create($branchId));
        });

        $customerData = [
            'id' => Str::uuid(),
            'branchId' => $branchId->getValue(),
            'name' => $this->faker->name,
            'balance' => $this->faker->numberBetween(0, 100000),
        ];

        $this->json('post', '/api/customers', $customerData)
            ->assertOk()
            ->assertJson([
                'data' => $customerData,
            ]);
    }
}
