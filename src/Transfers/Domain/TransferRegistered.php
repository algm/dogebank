<?php
declare(strict_types=1);

namespace Dogebank\Transfers\Domain;

use Dogebank\Shared\Domain\DomainEvent;

final class TransferRegistered extends TransferDomainEvent implements DomainEvent
{
    public static function eventName(): string
    {
        return 'dogebank.transfer.registered';
    }
}
