<?php
declare(strict_types=1);

namespace Tests\Customers\Domain;

use Dogebank\Customers\Domain\CustomerName;
use Tests\Shared\Domain\ObjectMother;

final class CustomerNameMother extends ObjectMother
{
    public static function create(?string $name = null): CustomerName
    {
        return new CustomerName($name ?? CustomerNameMother::random());
    }

    public static function random(): string
    {
        return CustomerNameMother::generator()->name;
    }
}
