<?php

namespace Dogebank\Customers\Infrastructure\Persistence;

use Dogebank\Branches\Domain\BranchCollection;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Domain\Customer;
use Dogebank\Customers\Domain\CustomerBalance;
use Dogebank\Customers\Domain\CustomerCollection;
use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Customers\Domain\CustomerName;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Infrastructure\Laravel\Persistence\BaseMysqlRepository;
use stdClass;

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
            [$id->getValue()]
        );

        if (empty($raw)) {
            return null;
        }

        return $this->resultToEntity($raw);
    }

    public function update(Customer $customer): void
    {
        $this->db->insert(
            "UPDATE {$this->tableName()} SET branch_id = ?, name = ?, balance = ? WHERE id = ?",
            [
                $customer->getBranchId()->getValue(),
                $customer->getName()->getValue(),
                $customer->getBalance()->getValue(),
                $customer->getId()->getValue(),
            ]
        );
    }

    public function calculateMaxBalanceForBranch(BranchId $branchId): float
    {
        $raw = $this->db->selectOne(
            "SELECT MAX(balance) as max_balance FROM {$this->tableName()} WHERE branch_id = ? GROUP BY branch_id",
            [
                $branchId->getValue(),
            ]
        );

        return $raw->max_balance ?? 0;
    }

    public function all(): CustomerCollection
    {
        /** @var stdClass[] $raw */
        $raw = $this->db->cursor(
            "SELECT id, name, branch_id, balance FROM {$this->tableName()} ORDER BY balance DESC",
        );

        $collection = $this->container->get(CustomerCollection::class);

        return $collection->merge($raw)->map(fn ($item) => $this->resultToEntity($item));
    }

    /**
     * @param mixed $raw
     * @return Customer
     */
    private function resultToEntity(mixed $raw): Customer
    {
        return new Customer(
            new CustomerId($raw->id),
            new BranchId($raw->branch_id),
            new CustomerName($raw->name),
            new CustomerBalance($raw->balance)
        );
    }
}
