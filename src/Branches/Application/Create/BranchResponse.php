<?php

declare(strict_types=1);

namespace Dogebank\Branches\Application\Create;

use Dogebank\Branches\Domain\Branch;
use Dogebank\Shared\Application\ResponseDTO;

final class BranchResponse implements ResponseDTO
{
    /**
     * BranchResponse constructor.
     *
     * @param Branch $branch
     */
    public function __construct(private Branch $branch)
    {
    }

    public static function fromEntity(Branch $branch): BranchResponse
    {
        return new BranchResponse($branch);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->branch->getId()->getValue(),
            'location' => $this->branch->getLocation()->getValue(),
            'maxBalance' => $this->branch->getMaxBalance()->getValue(),
        ];
    }
}
