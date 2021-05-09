<?php

declare(strict_types=1);

namespace Dogebank\Shared\Infrastructure\Laravel;

use Dogebank\Branches\Application\MaxBalanceUpdate\UpdateMaxBalanceOnCustomerBalanceUpdated;
use Dogebank\Branches\Application\MaxBalanceUpdate\UpdateMaxBalanceOnCustomerCreated;
use Dogebank\Customers\Application\BalanceUpdate\UpdateBalanceOnSuccessfulTransfer;
use Dogebank\Customers\Domain\CustomerBalanceUpdatedEvent;
use Dogebank\Customers\Domain\CustomerCreated;
use Dogebank\Transfers\Domain\TransferAccepted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

final class DogeBankEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        TransferAccepted::class => [
            UpdateBalanceOnSuccessfulTransfer::class,
        ],
        CustomerCreated::class => [
          UpdateMaxBalanceOnCustomerCreated::class,
        ],
        CustomerBalanceUpdatedEvent::class => [
            UpdateMaxBalanceOnCustomerBalanceUpdated::class,
        ],
    ];
}
