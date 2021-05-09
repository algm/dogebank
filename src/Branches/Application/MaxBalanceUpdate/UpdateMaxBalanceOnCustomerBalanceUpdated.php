<?php
declare(strict_types=1);

namespace Dogebank\Branches\Application\MaxBalanceUpdate;

use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Domain\CustomerBalanceUpdatedEvent;
use Dogebank\Shared\Domain\Bus\Event\DomainEventListener;

final class UpdateMaxBalanceOnCustomerBalanceUpdated implements DomainEventListener
{
    public function __construct(private MaxBalanceUpdater $updater)
    {
    }

    public function handle(CustomerBalanceUpdatedEvent $event): void
    {
        $this->updater->__invoke(
            new BranchId($event->getBody()['branchId'])
        );
    }
}
