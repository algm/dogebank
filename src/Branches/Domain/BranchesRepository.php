<?php
declare(strict_types=1);

namespace Dogebank\Branches\Domain;

interface BranchesRepository
{
    public function save(Branch $branch): void;

    public function find(BranchId $id): ?Branch;

    public function all(): BranchCollection;
}
