<?php
declare(strict_types=1);

namespace Dogebank\Branches\Application\MaxBalanceUpdate;

use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Domain\CustomerCreated;
use Dogebank\Shared\Domain\Bus\Event\DomainEventListener;

final class UpdateMaxBalanceOnCustomerCreated implements DomainEventListener
{
    public function __construct(private MaxBalanceUpdater $updater)
    {
    }

    public function handle(CustomerCreated $event): void
    {
        $this->updater->__invoke(
            new BranchId($event->getBody()['branchId'])
        );
    }
}
