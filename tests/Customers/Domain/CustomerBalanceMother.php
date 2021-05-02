<?php
declare(strict_types=1);


namespace Tests\Customers\Domain;

use Dogebank\Customers\Domain\CustomerBalance;
use Tests\Shared\Domain\ObjectMother;

final class CustomerBalanceMother extends ObjectMother
{
    public static function create(?float $balance = null): CustomerBalance
    {
        return new CustomerBalance($balance ?? CustomerBalanceMother::random());
    }

    public static function random(): float
    {
        return CustomerBalanceMother::generator()->numberBetween(0, 100000);
    }
}
