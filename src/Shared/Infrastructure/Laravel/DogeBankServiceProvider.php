<?php
declare(strict_types=1);


namespace Dogebank\Shared\Infrastructure\Laravel;


use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Customers\Infrastructure\Persistence\MysqlCustomersRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Dogebank\Shared\Infrastructure\Laravel\Bus\LaravelEventBus;
use Illuminate\Support\ServiceProvider;
use Dogebank\Branches\Infrastructure\Laravel\Persistence\MysqlBranchesRepository;

final class DogeBankServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EventBus::class, LaravelEventBus::class);
        $this->app->bind(BranchesRepository::class, MysqlBranchesRepository::class);
        $this->app->bind(CustomerRepository::class, MysqlCustomersRepository::class);
    }
}
