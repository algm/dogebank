<?php
declare(strict_types=1);

namespace Dogebank\Branches\Application\MaxBalanceUpdate;

use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;

final class MaxBalanceUpdater
{
    public function __construct(
        private BranchesRepository $repository,
        private EventBus $bus,
        private CustomerRepository $customerRepository
    ) {
    }

    public function __invoke(BranchId $branchId): void
    {
        $maxBalance = $this->customerRepository->calculateMaxBalanceForBranch($branchId);

        $branch = $this->repository->find($branchId);

        $branch->updateMaxBalance($maxBalance);

        $this->repository->save($branch);

        $this->bus->publish(...$branch->pullEvents());
    }
}
