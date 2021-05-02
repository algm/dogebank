<?php
declare(strict_types=1);


namespace Tests\Customers\Domain;

use Dogebank\Customers\Domain\CustomerId;
use Tests\Shared\Domain\UuidMother;

final class CustomerIdMother extends UuidMother
{
    public static function create(?string $uuid = null): CustomerId
    {
        return new CustomerId($uuid ?? CustomerIdMother::random());
    }
}
