<?php
declare(strict_types=1);


namespace Dogebank\Branches\Domain;


interface BranchesRepository
{
    public function save(Branch $branch): void;
}
