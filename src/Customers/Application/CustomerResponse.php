<?php


namespace Dogebank\Customers\Application;


use Dogebank\Customers\Domain\Customer;
use Dogebank\Shared\Application\ResponseDTO;

class CustomerResponse implements ResponseDTO
{

    public function __construct(private Customer $customer)
    {
    }

    public static function fromEntity(Customer $customer): CustomerResponse
    {
        return new CustomerResponse($customer);
    }

    public function toArray()
    {
        return [
            'id' => $this->customer->getId()->getValue(),
            'branchId' => $this->customer->getBranchId()->getValue(),
            'name' => $this->customer->getName()->getValue(),
            'balance' => $this->customer->getBalance()->getValue(),
        ];
    }
}
