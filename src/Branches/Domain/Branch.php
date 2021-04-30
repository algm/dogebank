<?php
declare(strict_types=1);


namespace Dogebank\Branches\Domain;


use Dogebank\Shared\Domain\AggregateRoot;

final class Branch extends AggregateRoot
{
    public function __construct(private BranchId $id, private BranchLocation $location)
    {
    }

    public static function create(BranchId $id, BranchLocation $location): Branch
    {
        $created = new Branch($id, $location);

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
}
