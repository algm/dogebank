<?php
declare(strict_types=1);


namespace Tests\Shared\Infrastructure;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $branch = BranchMother::create();

        $this->getBranchRepository()->save($branch);

        return $branch;
    }

    protected function generateSavedCustomerWithBalance(float $balance = 0): Customer
    {
        $branch = $this->generateSavedBranch();
        $branchId = $branch->getId();

        $customer = CustomerMother::create(branchId: $branchId, balance: CustomerBalanceMother::create($balance));

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
