<?php

declare(strict_types=1);

namespace Tests\Feature\Customers;

use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Tests\Customers\Domain\TransferAcceptedMother;
use Tests\Shared\Infrastructure\ApiTestCase;

final class UpdateCustomerBalanceWhenTransferAcceptedTest extends ApiTestCase
{
    public function testCustomerBalanceGetsUpdatedWhenTransfersAreAccepted()
    {
        $customer1 = $this->generateSavedCustomerWithBalance(1000);
        $customer2 = $this->generateSavedCustomerWithBalance();

        $bus = $this->app->get(EventBus::class);
        $transferAcceptedEvent = TransferAcceptedMother::create(
            from: $customer1->getId()->getValue(),
            to: $customer2->getId()->getValue(),
            amount: 10
        );

        $bus->publish($transferAcceptedEvent);

        $updatedCustomer1 = $this->getCustomerRepository()->find($customer1->getId());
        $updatedCustomer2 = $this->getCustomerRepository()->find($customer2->getId());

        $this->assertEquals(990, $updatedCustomer1->getBalance()->getValue());
        $this->assertEquals(10, $updatedCustomer2->getBalance()->getValue());
    }
}
