<?php


namespace Tests\Branches\Domain;


use Dogebank\Branches\Application\Create\BranchCreateRequest;
use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Branches\Domain\BranchLocation;

final class BranchMother
{
    public static function create(?BranchId $id = null, ?BranchLocation $location = null): Branch
    {
        return new Branch(
            $id ?? BranchIdMother::create(),
            $location ?? BranchLocationMother::create(),
        );
    }

    public static function fromRequest(BranchCreateRequest $request): Branch
    {
        return BranchMother::create(new BranchId($request->getId()), new BranchLocation($request->getLocation()));
    }
}
