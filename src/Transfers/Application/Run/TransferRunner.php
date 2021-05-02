<?php

declare(strict_types=1);

namespace Dogebank\Transfers\Application\Run;

use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Dogebank\Transfers\Domain\Transfer;
use Dogebank\Transfers\Domain\TransferAmount;
use Dogebank\Transfers\Domain\TransferFrom;
use Dogebank\Transfers\Domain\TransferId;
use Dogebank\Transfers\Domain\TransferRepository;
use Dogebank\Transfers\Domain\TransferTo;
use InvalidArgumentException;

final class TransferRunner
{
    public function __construct(
        private CustomerRepository $customerRepository,
        private TransferRepository $transferRepository,
        private EventBus $bus
    ) {
    }

    public function __invoke(TransferRunRequest $runRequest): TransferResponse
    {
        $this->ensureCustomerExists($runRequest->getFrom());
        $this->ensureCustomerExists($runRequest->getTo());

        $from = new TransferFrom($runRequest->getFrom());
        $to = new TransferTo($runRequest->getTo());

        $transfer = Transfer::register(
            new TransferId($runRequest->getId()),
            $from,
            $to,
            new TransferAmount($runRequest->getAmount())
        );

        $hasEnoughFunds = $this->checkCustomerHasEnoughFunds($runRequest->getFrom(), $runRequest->getAmount());

        if ($hasEnoughFunds) {
            $transfer->approve();
        }

        if (!$hasEnoughFunds) {
            $transfer->reject('INSUFFICIENT_FUNDS');
        }

        $this->transferRepository->save($transfer);
        $this->bus->publish(...$transfer->pullEvents());

        return TransferResponse::fromEntity($transfer);
    }

    private function ensureCustomerExists(string $customerId): void
    {
        $found = $this->customerRepository->find(new CustomerId($customerId));

        if (empty($found)) {
            throw new InvalidArgumentException("Customer $customerId does not exist");
        }
    }

    private function checkCustomerHasEnoughFunds(string $customerId, float $amount): bool
    {
        $customer = $this->customerRepository->find(new CustomerId($customerId));

        return $customer->balanceIsGreaterThan($amount);
    }
}
