<?php
declare(strict_types=1);

namespace Dogebank\Customers\Domain;

use Dogebank\Branches\Domain\BranchId;

interface CustomerRepository
{
    public function save(Customer $customer): void;

    public function find(CustomerId $id): ?Customer;

    public function update(Customer $customer): void;

    public function calculateMaxBalanceForBranch(BranchId $branchId): float;
}
