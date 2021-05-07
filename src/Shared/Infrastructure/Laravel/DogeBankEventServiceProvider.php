<?php
declare(strict_types=1);


namespace Dogebank\Shared\Infrastructure\Laravel;


use Dogebank\Customers\Application\BalanceUpdate\UpdateBalanceOnSuccessfulTransfer;
use Dogebank\Transfers\Domain\TransferAccepted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

final class DogeBankEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        TransferAccepted::class => [
            UpdateBalanceOnSuccessfulTransfer::class,
        ],
    ];
}
