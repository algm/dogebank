<?php

declare(strict_types=1);

namespace Tests\Unit\Customers\Application\Create;

use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Customers\Application\Create\CustomerCreator;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Mockery\MockInterface;
use Tests\Branches\Domain\BranchIdMother;
use Tests\Branches\Domain\BranchMother;
use Tests\Customers\Application\CustomerCreateRequestMother;
use Tests\TestCase;

final class CustomerCreatorTest extends TestCase
{
    public function testCreatesValidBranches()
    {
        $branchId = BranchIdMother::create();

        $busSpy = $this->spy(EventBus::class);
        $repoSpy = $this->spy(CustomerRepository::class);
        $this->mock(BranchesRepository::class, function (MockInterface $mock) use ($branchId) {
            $mock->shouldReceive('find')
                ->andReturn(BranchMother::create(id: $branchId));
        });

        $request = CustomerCreateRequestMother::create(branchId: $branchId->getValue());

        $response = $this->getService()->__invoke($request);

        $this->assertEquals($response->toArray()['id'], $request->getId());
        $repoSpy->shouldHaveReceived('save');
        $busSpy->shouldHaveReceived('publish');
    }

    protected function getService(): CustomerCreator
    {
        return $this->app->get(CustomerCreator::class);
    }
}
