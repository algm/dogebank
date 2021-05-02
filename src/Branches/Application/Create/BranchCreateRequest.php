<?php
declare(strict_types=1);


namespace Dogebank\Branches\Application\Create;

final class BranchCreateRequest
{
    public function __construct(private string $id, private string $location)
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    public static function fromArray(array $data): BranchCreateRequest
    {
        return new BranchCreateRequest($data['id'], $data['location']);
    }
}
