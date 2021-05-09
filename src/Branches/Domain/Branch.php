<?php
declare(strict_types=1);


namespace Dogebank\Branches\Domain;

use Dogebank\Shared\Domain\AggregateRoot;

final class Branch extends AggregateRoot
{
    public function __construct(
        private BranchId $id,
        private BranchLocation $location,
        private BranchMaxBalance $maxBalance
    ) {
    }

    public static function create(BranchId $id, BranchLocation $location, ?BranchMaxBalance $maxBalance = null): Branch
    {
        $created = new Branch($id, $location, $maxBalance ?? new BranchMaxBalance(0));

        $created->recordThat(new BranchCreated($id->getValue(), [
            'location' => $location->getValue(),
        ]));

        return $created;
    }

    /**
     * @return BranchId
     */
    public function getId(): BranchId
    {
        return $this->id;
    }

    /**
     * @return BranchLocation
     */
    public function getLocation(): BranchLocation
    {
        return $this->location;
    }

    public function getMaxBalance(): BranchMaxBalance
    {
        return $this->maxBalance;
    }

    public function updateMaxBalance(float $maxBalance): void
    {
        $this->maxBalance = new BranchMaxBalance($maxBalance);
    }
}
