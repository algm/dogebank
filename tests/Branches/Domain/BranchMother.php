<?php
declare(strict_types=1);

namespace Tests\Branches\Domain;

use Dogebank\Branches\Application\Create\BranchCreateRequest;
use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Branches\Domain\BranchLocation;
use Dogebank\Branches\Domain\BranchMaxBalance;

final class BranchMother
{
    public static function create(
        ?BranchId $id = null,
        ?BranchLocation $location = null,
        ?BranchMaxBalance $maxBalance = null
    ): Branch {
        return new Branch(
            $id ?? BranchIdMother::create(),
            $location ?? BranchLocationMother::create(),
            $maxBalance ?? BranchMaxBalanceMother::create(),
        );
    }

    public static function fromRequest(BranchCreateRequest $request): Branch
    {
        return BranchMother::create(new BranchId($request->getId()), new BranchLocation($request->getLocation()));
    }
}
