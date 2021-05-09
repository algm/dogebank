<?php
declare(strict_types=1);


namespace Tests\Shared\Infrastructure;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\Branches\Domain\BranchMaxBalanceMother;
use Tests\Branches\Domain\BranchMother;
use Tests\Customers\Domain\CustomerBalanceMother;
use Tests\Customers\Domain\CustomerMother;
use Tests\TestCase;

abstract class ApiTestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    protected function generateSavedBranch(): Branch
    {
        $branch = BranchMother::create(maxBalance: BranchMaxBalanceMother::create(0));

        $this->getBranchRepository()->save($branch);

        return $branch;
    }

    protected function generateSavedBranches(int $howMany = 5): Collection
    {
        return Collection::make(range(1, $howMany))->map(fn () => $this->generateSavedBranch());
    }

    protected function generateSavedCustomerWithBalance(float $balance = 0, ?string $branchId = null): Customer
    {
        if (empty($branchId)) {
            $branch = $this->generateSavedBranch();
            $branchId = $branch->getId()->getValue();
        }

        $branchIdInstance = new BranchId($branchId);

        $customer = CustomerMother::create(
            branchId: $branchIdInstance,
            balance: CustomerBalanceMother::create($balance)
        );

        $this->getCustomerRepository()->save($customer);

        return $customer;
    }

    protected function getBranchRepository(): BranchesRepository
    {
        return $this->app->get(BranchesRepository::class);
    }

    protected function getCustomerRepository(): CustomerRepository
    {
        return $this->app->get(CustomerRepository::class);
    }
}
