<?php

declare(strict_types=1);

namespace Dogebank\Shared\Infrastructure\Laravel;

use Dogebank\Branches\Domain\BranchCollection;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Infrastructure\Laravel\LaravelBranchCollection;
use Dogebank\Branches\Infrastructure\Laravel\Persistence\MysqlBranchesRepository;
use Dogebank\Customers\Domain\CustomerCollection;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Customers\Infrastructure\LaravelCustomerCollection;
use Dogebank\Customers\Infrastructure\Persistence\MysqlCustomersRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Dogebank\Shared\Infrastructure\Laravel\Bus\LaravelEventBus;
use Dogebank\Transfers\Domain\TransferRepository;
use Dogebank\Transfers\Infrastructure\MysqlTransferRepository;
use Illuminate\Support\ServiceProvider;

final class DogeBankServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EventBus::class, LaravelEventBus::class);
        $this->app->bind(BranchesRepository::class, MysqlBranchesRepository::class);
        $this->app->bind(CustomerRepository::class, MysqlCustomersRepository::class);
        $this->app->bind(TransferRepository::class, MysqlTransferRepository::class);
        $this->app->bind(BranchCollection::class, LaravelBranchCollection::class);
        $this->app->bind(CustomerCollection::class, LaravelCustomerCollection::class);
    }
}
