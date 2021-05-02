<?php

declare(strict_types=1);

namespace Tests\Customers\Domain;

use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Application\Create\CustomerCreateRequest;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerBalance;
use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Customers\Domain\CustomerName;
use Tests\Branches\Domain\BranchIdMother;

final class CustomerMother
{
    public static function create(
        ?CustomerId $id = null,
        ?BranchId $branchId = null,
        ?CustomerName $name = null,
        ?CustomerBalance $balance = null
    ): Customer {
        return new Customer(
            $id ?? CustomerIdMother::create(),
            $branchId ?? BranchIdMother::create(),
            $name ?? CustomerNameMother::create(),
            $balance ?? CustomerBalanceMother::create(),
        );
    }

    public static function fromRequest(CustomerCreateRequest $request): Customer
    {
        return CustomerMother::create(
            new CustomerId($request->getId()),
            new BranchId($request->getBranchId()),
            new CustomerName($request->getName()),
            new CustomerBalance($request->getBalance())
        );
    }
}
