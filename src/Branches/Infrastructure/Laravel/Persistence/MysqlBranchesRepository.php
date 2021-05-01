<?php
declare(strict_types=1);


namespace Dogebank\Branches\Infrastructure\Laravel\Persistence;


use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Branches\Domain\BranchLocation;
use Dogebank\Shared\Infrastructure\Laravel\Persistence\BaseMysqlRepository;

final class MysqlBranchesRepository extends BaseMysqlRepository implements BranchesRepository
{
    public const TABLE = 'branches';

    public function save(Branch $branch): void
    {
        $this->db->insert(
            "INSERT INTO {$this->tableName()} (id, location) VALUES(?, ?)",
            [$branch->getId(), $branch->getLocation()]
        );
    }

    public function find(BranchId $id): ?Branch
    {
        $raw = $this->db->selectOne(
            "SELECT id, location FROM {$this->tableName()} WHERE id = ?",
            [$id->getValue()]
        );

        if (empty($raw)) {
            return null;
        }

        return new Branch(
            new BranchId($raw->id),
            new BranchLocation($raw->location)
        );
    }
}
