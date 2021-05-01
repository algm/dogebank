<?php


namespace Dogebank\Customers\Domain;


use Dogebank\Branches\Domain\BranchId;
use Dogebank\Shared\Domain\AggregateRoot;

class Customer extends AggregateRoot
{
    public function __construct(
        private CustomerId $id,
        private BranchId $branchId,
        private CustomerName $name,
        private CustomerBalance $balance
    ) {
    }

    public static function create(
        CustomerId $id,
        BranchId $branchId,
        CustomerName $name,
        CustomerBalance $balance
    ): Customer {
        $customer = new Customer(
            $id,
            $branchId,
            $name,
            $balance
        );

        $customer->recordThat(new CustomerCreated($id->getValue(), [
            'branchId' => $branchId->getValue(),
            'name' => $name->getValue(),
            'balance' => $balance->getValue(),
        ]));

        return $customer;
    }

    /**
     * @return CustomerId
     */
    public function getId(): CustomerId
    {
        return $this->id;
    }

    /**
     * @return BranchId
     */
    public function getBranchId(): BranchId
    {
        return $this->branchId;
    }

    /**
     * @return CustomerName
     */
    public function getName(): CustomerName
    {
        return $this->name;
    }

    /**
     * @return CustomerBalance
     */
    public function getBalance(): CustomerBalance
    {
        return $this->balance;
    }
}
