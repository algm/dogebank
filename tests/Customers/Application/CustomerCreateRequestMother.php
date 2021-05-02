<?php

declare(strict_types=1);

namespace Tests\Customers\Application;

use Dogebank\Branches\Application\Create\BranchCreateRequest;
use Dogebank\Customers\Application\Create\CustomerCreateRequest;
use Dogebank\Customers\Domain\CustomerBalance;
use Illuminate\Support\Str;
use Tests\Branches\Domain\BranchIdMother;
use Tests\Customers\Domain\CustomerBalanceMother;
use Tests\Customers\Domain\CustomerNameMother;
use Tests\Shared\Domain\ObjectMother;

final class CustomerCreateRequestMother extends ObjectMother
{
    public static function create(
        ?string $id = null,
        ?string $branchId = null,
        ?string $name = null,
        ?string $balance = null
    ): CustomerCreateRequest {
        return CustomerCreateRequest::fromArray([
            'id' => $id ?? Str::uuid()->toString(),
            'branchId' => $branchId ?? BranchIdMother::create()->getValue(),
            'name' => $name ?? CustomerNameMother::create()->getValue(),
            'balance' => $balance ?? CustomerBalanceMother::create()->getValue(),
        ]);
    }
}
