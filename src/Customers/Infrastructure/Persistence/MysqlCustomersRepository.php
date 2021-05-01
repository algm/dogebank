<?php

namespace Dogebank\Customers\Infrastructure\Persistence;

use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerBalance;
use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Customers\Domain\CustomerName;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Infrastructure\Laravel\Persistence\BaseMysqlRepository;

class MysqlCustomersRepository extends BaseMysqlRepository implements CustomerRepository
{
    public const TABLE = 'customers';

    public function save(Customer $customer): void
    {
        $this->db->insert(
            "INSERT INTO {$this->tableName()} (id, branch_id, name, balance) VALUES(?, ?, ?, ?)",
            [
                $customer->getId()->getValue(),
                $customer->getBranchId()->getValue(),
                $customer->getName()->getValue(),
                $customer->getBalance()->getValue(),
            ]
        );
    }

    public function find(CustomerId $id): ?Customer
    {
        $raw = $this->db->selectOne(
            "SELECT id, branch_id, name, balance FROM {$this->tableName()} WHERE id = ?",
            $id->getValue()
        );

        if (empty($raw)) {
            return null;
        }

        return new Customer(
            new CustomerId($raw->id),
            new BranchId($raw->branch_id),
            new CustomerName($raw->name),
            new CustomerBalance($raw->balance)
        );
    }
}
