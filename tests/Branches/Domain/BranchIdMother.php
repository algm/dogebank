<?php


namespace Tests\Branches\Domain;


use Dogebank\Branches\Domain\BranchId;
use Tests\Shared\Domain\UuidMother;

class BranchIdMother extends UuidMother
{
    public static function create(?string $uuid = null): BranchId
    {
        return new BranchId($uuid ?? static::random());
    }
}
