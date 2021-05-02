<?php
declare(strict_types=1);


namespace Dogebank\Transfers\Application\Run;

final class TransferRunRequest
{
    public function __construct(private string $id, private string $from, private string $to, private float $amount)
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
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    public static function fromArray(array $data): TransferRunRequest
    {
        return new TransferRunRequest(
            $data['id'],
            $data['from'],
            $data['to'],
            $data['amount']
        );
    }
}
