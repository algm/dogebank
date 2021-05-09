<?php

declare(strict_types=1);

namespace Tests\Feature\Branches;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Customers\Domain\CustomerCreated;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Tests\Shared\Infrastructure\ApiTestCase;

final class UpdateBranchMaxBalanceWhenCustomerCreatedTest extends ApiTestCase
{
    public function testMaxBalanceIsUpdatedWhenNewCustomersAreCreated()
    {
        $repository = $this->app->get(BranchesRepository::class);
        $bus = $this->app->get(EventBus::class);
        $branch = $this->generateSavedBranch();
        $branchId = $branch->getId();
        $initialMaxBalance = $branch->getMaxBalance()->getValue();
        $customer1 = $this->generateSavedCustomerWithBalance(10, $branchId->getValue());

        $bus->publish(new CustomerCreated($customer1->getId()->getValue(), [
            'branchId' => $branchId->getValue(),
            'name' => $customer1->getName()->getValue(),
            'balance' => $customer1->getBalance()->getValue(),
        ]));

        /** @var Branch $updatedBranch */
        $updatedBranch = $repository->find($branchId);
        $updatedMaxBalance = $updatedBranch->getMaxBalance()->getValue();

        $this->assertEquals(0, $initialMaxBalance);
        $this->assertEquals(10, $updatedMaxBalance);
    }
}
