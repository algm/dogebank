<?php


namespace Dogebank\Customers\Application\Create;


class CustomerCreateRequest
{
    public function __construct(
        private string $id, 
        private string $branchId, 
        private string $name, 
        private float $balance) {
    }

    /**
     * @return string
     */
    public function getBranchId(): string
    {
        return $this->branchId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public static function fromArray(array $data): CustomerCreateRequest
    {
        return new CustomerCreateRequest($data['id'], $data['branchId'], $data['name'], $data['balance']);
    }
}
