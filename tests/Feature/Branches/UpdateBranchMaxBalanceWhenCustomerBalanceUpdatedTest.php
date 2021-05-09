<?php

declare(strict_types=1);

namespace Tests\Feature\Branches;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Customers\Domain\CustomerBalanceDecreased;
use Dogebank\Customers\Domain\CustomerBalanceIncreased;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Tests\Shared\Infrastructure\ApiTestCase;

final class UpdateBranchMaxBalanceWhenCustomerBalanceUpdatedTest extends ApiTestCase
{
    public function testMaxBalanceIsUpdatedWhenBalanceIncreased()
    {
        $repository = $this->app->get(BranchesRepository::class);
        $bus = $this->app->get(EventBus::class);
        $branch = $this->generateSavedBranch();
        $branchId = $branch->getId();
        $initialMaxBalance = $branch->getMaxBalance()->getValue();
        $customer1 = $this->generateSavedCustomerWithBalance(10, $branchId->getValue());
        $this->generateSavedCustomerWithBalance(90, $branchId->getValue());

        $bus->publish(new CustomerBalanceIncreased($customer1->getId()->getValue(), [
            'branchId' => $branchId->getValue(),
            'amount' => 10,
        ]));

        /** @var Branch $updatedBranch */
        $updatedBranch = $repository->find($branchId);
        $updatedMaxBalance = $updatedBranch->getMaxBalance()->getValue();

        $this->assertEquals(0, $initialMaxBalance);
        $this->assertEquals(90, $updatedMaxBalance);
    }

    public function testMaxBalanceIsUpdatedWhenBalanceDecreased()
    {
        $repository = $this->app->get(BranchesRepository::class);
        $bus = $this->app->get(EventBus::class);
        $branch = $this->generateSavedBranch();
        $branchId = $branch->getId();
        $initialMaxBalance = $branch->getMaxBalance()->getValue();
        $customer1 = $this->generateSavedCustomerWithBalance(10, $branchId->getValue());
        $this->generateSavedCustomerWithBalance(90, $branchId->getValue());

        $bus->publish(new CustomerBalanceDecreased($customer1->getId()->getValue(), [
            'branchId' => $branchId->getValue(),
            'amount' => 10,
        ]));

        /** @var Branch $updatedBranch */
        $updatedBranch = $repository->find($branchId);
        $updatedMaxBalance = $updatedBranch->getMaxBalance()->getValue();

        $this->assertEquals(0, $initialMaxBalance);
        $this->assertEquals(90, $updatedMaxBalance);
    }
}
