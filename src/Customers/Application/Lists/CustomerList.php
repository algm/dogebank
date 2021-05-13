<?php
declare(strict_types=1);


namespace Dogebank\Customers\Application\Lists;

use Dogebank\Customers\Application\CustomerResponse;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerRepository;

final class CustomerList
{
    public function __construct(private CustomerRepository $repository)
    {
    }

    public function __invoke(): iterable
    {
        $customers = $this->repository->all();

        return $customers->map(fn (Customer $customer) => CustomerResponse::fromEntity($customer));
    }
}
