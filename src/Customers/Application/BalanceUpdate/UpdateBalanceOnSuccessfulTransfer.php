<?php
declare(strict_types=1);


namespace Dogebank\Customers\Application\BalanceUpdate;

use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Shared\Domain\Bus\Event\DomainEventListener;
use Dogebank\Transfers\Domain\TransferAccepted;
use Dogebank\Transfers\Domain\TransferAmount;

final class UpdateBalanceOnSuccessfulTransfer implements DomainEventListener
{
    public function __construct(private BalanceUpdater $balanceUpdater)
    {
    }

    public function handle(TransferAccepted $event): void
    {
        $body = $event->getBody();

        $from = new CustomerId($body['from']);
        $to = new CustomerId($body['to']);
        $amount = $body['amount'];

        $this->balanceUpdater->__invoke($from, $to, $amount);
    }
}
