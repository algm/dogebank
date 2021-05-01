<?php

namespace Tests\Branches\Application;

use Dogebank\Branches\Application\Create\BranchCreateRequest;
use Illuminate\Support\Str;
use Tests\Branches\Domain\BranchLocationMother;
use Tests\Shared\Domain\ObjectMother;

class BranchCreateRequestMother extends ObjectMother
{
    public static function create(?string $id = null, ?string $location = null): BranchCreateRequest
    {
        return BranchCreateRequest::fromArray([
            'id' => $id ?? Str::uuid()->toString(),
            'location' => $location ?? BranchLocationMother::create()->getValue(),
        ]);
    }
}
