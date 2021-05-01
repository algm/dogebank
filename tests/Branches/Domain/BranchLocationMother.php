<?php

namespace Tests\Branches\Domain;

use Dogebank\Branches\Domain\BranchLocation;
use Tests\Shared\Domain\ObjectMother;

class BranchLocationMother extends ObjectMother
{
    public static function create(?string $location = null): BranchLocation
    {
        return new BranchLocation($location ?? static::random());
    }

    public static function random(): string
    {
        return static::generator()->city;
    }
}
