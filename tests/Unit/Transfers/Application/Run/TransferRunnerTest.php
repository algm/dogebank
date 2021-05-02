<?php

declare(strict_types=1);

namespace Tests\Unit\Transfers\Application\Run;

use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Dogebank\Transfers\Application\Run\TransferRunner;
use Dogebank\Transfers\Domain\TransferRepository;
use Mockery\MockInterface;
use Tests\Customers\Domain\CustomerBalanceMother;
use Tests\Customers\Domain\CustomerMother;
use Tests\TestCase;
use Tests\Transfers\Application\TransferRunRequestMother;

final class TransferRunnerTest extends TestCase
{
    public function testTransfersCanBeRunWhenOriginCustomerHasEnoughBalance()
    {
        $bus = $this->getEventBusSpy();
        $repo = $this->getTransferRepoSpy();
        $from = CustomerMother::create(balance: CustomerBalanceMother::create(1000));
        $to = CustomerMother::create();

        $this->mock(CustomerRepository::class, function (MockInterface $mock) use ($from, $to) {
            $mock->shouldReceive('find')->andReturn($from);
            $mock->shouldReceive('find')->andReturn($to);
        });

        $request = TransferRunRequestMother::create(
            from: $from->getId()->getValue(),
            to: $to->getId()->getValue(),
            amount: 10
        );

        $response = $this->getService()->__invoke($request);

        $repo->shouldHaveReceived('save');
        $bus->shouldHaveReceived('publish');

        $status = $response->getStatus();

        $this->assertEquals('OK', $status);
    }

    public function testTransfersAreRejectedWhenOriginCustomerDoesNotHaveEnoughBalance()
    {
        $bus = $this->getEventBusSpy();
        $repo = $this->getTransferRepoSpy();
        $from = CustomerMother::create(balance: CustomerBalanceMother::create(10));
        $to = CustomerMother::create();

        $this->mock(CustomerRepository::class, function (MockInterface $mock) use ($from, $to) {
            $mock->shouldReceive('find')->andReturn($from);
            $mock->shouldReceive('find')->andReturn($to);
        });

        $request = TransferRunRequestMother::create(
            from: $from->getId()->getValue(),
            to: $to->getId()->getValue(),
            amount: 1000
        );

        $response = $this->getService()->__invoke($request);

        $repo->shouldHaveReceived('save');
        $bus->shouldHaveReceived('publish');

        $status = $response->getStatus();
        $reason = $response->getReason();

        $this->assertEquals('REJECTED', $status);
        $this->assertEquals('INSUFFICIENT_FUNDS', $reason);
    }

    private function getService(): TransferRunner
    {
        return $this->app->get(TransferRunner::class);
    }

    private function getEventBusSpy(): MockInterface | EventBus
    {
        return $this->spy(EventBus::class);
    }

    private function getTransferRepoSpy(): MockInterface | TransferRepository
    {
        return $this->spy(TransferRepository::class);
    }
}
