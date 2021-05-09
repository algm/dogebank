<?php

declare(strict_types=1);

namespace Dogebank\Branches\Infrastructure\Laravel\Persistence;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchCollection;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Branches\Domain\BranchLocation;
use Dogebank\Branches\Domain\BranchMaxBalance;
use Dogebank\Shared\Infrastructure\Laravel\Persistence\BaseMysqlRepository;
use stdClass;

final class MysqlBranchesRepository extends BaseMysqlRepository implements BranchesRepository
{
    public const TABLE = 'branches';

    public function save(Branch $branch): void
    {
        if (empty($this->find($branch->getId()))) {
            $this->db->insert(
                "INSERT INTO {$this->tableName()} (id, location) VALUES(?, ?)",
                [$branch->getId(), $branch->getLocation()]
            );
        }

        $this->db->update(
            "UPDATE {$this->tableName()} SET location = ?, max_balance = ? WHERE id = ?",
            [$branch->getLocation(), $branch->getMaxBalance()->getValue(), $branch->getId()]
        );
    }

    public function find(BranchId $id): ?Branch
    {
        $raw = $this->db->selectOne(
            "SELECT id, location, max_balance FROM {$this->tableName()} WHERE id = ?",
            [$id->getValue()]
        );

        if (empty($raw)) {
            return null;
        }

        return $this->resultToEntity($raw);
    }

    public function all(): BranchCollection
    {
        /** @var stdClass[] $raw */
        $raw = $this->db->cursor(
            "SELECT id, location, max_balance FROM {$this->tableName()} ORDER BY max_balance DESC",
        );

        $collection = $this->container->get(BranchCollection::class);

        return $collection->merge($raw)->map(fn ($item) => $this->resultToEntity($item));
    }

    /**
     * @param mixed $raw
     */
    private function resultToEntity(stdClass $raw): Branch
    {
        return new Branch(
            new BranchId($raw->id),
            new BranchLocation($raw->location),
            new BranchMaxBalance($raw->max_balance)
        );
    }
}
