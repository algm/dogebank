<?php

declare(strict_types=1);

namespace Dogebank\Transfers\Domain;

use Dogebank\Shared\Domain\AggregateRoot;

final class Transfer extends AggregateRoot
{
    public function __construct(
        private TransferId $id,
        private TransferFrom $from,
        private TransferTo $to,
        private TransferAmount $amount,
        private TransferStatus $status,
        private TransferReason $reason
    ) {
    }

    public static function register(
        TransferId $id,
        TransferFrom $from,
        TransferTo $to,
        TransferAmount $amount
    ): Transfer {
        $transfer = new Transfer($id, $from, $to, $amount, new TransferStatus('PENDING'), new TransferReason());

        $transfer->recordThat(new TransferRegistered($id->getValue(), [
            'from' => $from->getValue(),
            'to' => $to->getValue(),
            'amount' => $amount->getValue(),
        ]));

        return $transfer;
    }

    public function getId(): TransferId
    {
        return $this->id;
    }

    public function getFrom(): TransferFrom
    {
        return $this->from;
    }

    public function getTo(): TransferTo
    {
        return $this->to;
    }

    public function getAmount(): TransferAmount
    {
        return $this->amount;
    }

    public function getStatus(): TransferStatus
    {
        return $this->status;
    }

    public function getReason(): TransferReason
    {
        return $this->reason;
    }

    public function approve(): Transfer
    {
        $this->status = new TransferStatus('OK');

        $this->recordThat(new TransferAccepted($this->id->getValue(), [
            'from' => $this->from->getValue(),
            'to' => $this->to->getValue(),
            'amount' => $this->amount->getValue(),
        ]));

        return $this;
    }

    public function reject(string $reason): Transfer
    {
        $this->status = new TransferStatus('REJECTED');
        $this->reason = new TransferReason($reason);

        $this->recordThat(new TransferRejected($this->id->getValue(), [
            'from' => $this->from->getValue(),
            'to' => $this->to->getValue(),
            'amount' => $this->amount->getValue(),
            'reason' => $this->reason->getValue(),
        ]));

        return $this;
    }
}
