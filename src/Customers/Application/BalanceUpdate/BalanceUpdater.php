<?php
declare(strict_types=1);


namespace Dogebank\Customers\Application\BalanceUpdate;

use Dogebank\Customers\Domain\CustomerId;
use Dogebank\Customers\Domain\CustomerRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use InvalidArgumentException;

final class BalanceUpdater
{
    public function __construct(private CustomerRepository $customerRepository, private EventBus $bus)
    {
    }

    public function __invoke(CustomerId $from, CustomerId $to, float $amount): void
    {
        $this->ensureCustomerExists($from->getValue());
        $this->ensureCustomerExists($to->getValue());

        $fromCustomer = $this->customerRepository->find($from);
        $toCustomer = $this->customerRepository->find($to);

        $fromCustomer->decrementBalance($amount);
        $toCustomer->incrementBalance($amount);

        $this->customerRepository->update($fromCustomer);
        $this->customerRepository->update($toCustomer);

        $this->bus->publish(...$fromCustomer->pullEvents());
        $this->bus->publish(...$toCustomer->pullEvents());
    }

    private function ensureCustomerExists(string $customerId): void
    {
        $found = $this->customerRepository->find(new CustomerId($customerId));

        if (empty($found)) {
            throw new InvalidArgumentException("Customer $customerId does not exist");
        }
    }
}
