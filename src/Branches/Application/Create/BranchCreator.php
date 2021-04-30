<?php
declare(strict_types=1);


namespace Dogebank\Branches\Application\Create;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Branches\Domain\BranchId;
use Dogebank\Branches\Domain\BranchLocation;
use Dogebank\Shared\Domain\Bus\Event\EventBus;

final class BranchCreator
{
    public function __construct(private BranchesRepository $branchesRepository, private EventBus $bus)
    {
    }

    public function __invoke(BranchCreateRequest $request): BranchResponse
    {
        $branch = Branch::create(
            new BranchId($request->getId()),
            new BranchLocation($request->getLocation()),
        );

        $this->branchesRepository->save($branch);

        $this->bus->publish(...$branch->pullEvents());

        return BranchResponse::fromEntity($branch);
    }
}
