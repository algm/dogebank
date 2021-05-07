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

    public function getId(): CustomerId
    {
        return $this->id;
    }

    public function getBranchId(): BranchId
    {
        return $this->branchId;
    }

    public function getName(): CustomerName
    {
        return $this->name;
    }

    public function getBalance(): CustomerBalance
    {
        return $this->balance;
    }

    public function balanceIsGreaterThan(float $amount): bool
    {
        return $this->getBalance()->getValue() >= $amount;
    }

    public function decrementBalance(float $amount): void
    {
        $this->balance = new CustomerBalance(
            $this->balance->getValue() - $amount
        );

        $this->recordThat(new CustomerBalanceDecreased(
            $this->id->getValue(),
            [
               'amount' => $amount,
            ]
        ));
    }

    public function incrementBalance(float $amount): void
    {
        $this->balance = new CustomerBalance(
            $this->balance->getValue() + $amount
        );

        $this->recordThat(new CustomerBalanceIncreased(
            $this->id->getValue(),
            [
               'amount' => $amount,
            ]
        ));
    }
}
