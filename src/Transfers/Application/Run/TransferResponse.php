<?php
declare(strict_types=1);


namespace Dogebank\Transfers\Application\Run;


use Dogebank\Shared\Application\ResponseDTO;
use Dogebank\Transfers\Domain\Transfer;

final class TransferResponse implements ResponseDTO
{
    public function __construct(private Transfer $transfer)
    {
    }

    public static function fromEntity(Transfer $transfer): TransferResponse
    {
        return new TransferResponse($transfer);
    }

    public function toArray()
    {
        return [
            'id' => $this->transfer->getId()->getValue(),
            'from' => $this->transfer->getFrom()->getValue(),
            'to' => $this->transfer->getTo()->getValue(),
            'amount' => $this->transfer->getAmount()->getValue(),
            'status' => $this->transfer->getStatus()->getValue(),
            'reason' => $this->transfer->getReason()->getValue(),
        ];
    }

    public function getStatus(): string
    {
        return $this->transfer->getStatus()->getValue();
    }

    public function getReason(): string
    {
        return $this->transfer->getReason()->getValue();
    }
}
