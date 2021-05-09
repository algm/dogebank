<?php
declare(strict_types=1);


namespace Dogebank\Branches\Application\Report;

use Dogebank\Branches\Application\Create\BranchResponse;
use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;

final class BranchReporter
{
    public function __construct(private BranchesRepository $repository)
    {
    }

    public function __invoke(): iterable
    {
        $allBranches = $this->repository->all();

        return $allBranches->map(fn (Branch $branch) => BranchResponse::fromEntity($branch));
    }
}
