<?php
declare(strict_types=1);


namespace Tests\Branches\Domain;


use Dogebank\Branches\Domain\BranchMaxBalance;
use Tests\Shared\Domain\ObjectMother;

final class BranchMaxBalanceMother extends ObjectMother
{
    public static function create(?float $balance = null): BranchMaxBalance
    {
        return new BranchMaxBalance($balance ?? BranchMaxBalanceMother::generator()->numberBetween(0, 10000));
    }
}
