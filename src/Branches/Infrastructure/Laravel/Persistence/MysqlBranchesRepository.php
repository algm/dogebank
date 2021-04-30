<?php
declare(strict_types=1);


namespace Dogebank\Branches\Infrastructure\Laravel\Persistence;


use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
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
}
