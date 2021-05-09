<?php
declare(strict_types=1);


namespace Dogebank\Customers\Domain;

use Dogebank\Shared\Domain\Bus\Event\BaseDomainEvent;
use Dogebank\Shared\Domain\DomainEvent;

final class CustomerBalanceDecreased extends BaseDomainEvent implements DomainEvent, CustomerBalanceUpdatedEvent
{

    public function __construct(
        string $aggregateId,
        private array $body,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): BaseDomainEvent {
        return new CustomerBalanceIncreased($aggregateId, $body, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'dogebank.customer.balance_decreased';
    }

    public function toPrimitives(): array
    {
        return array_merge($this->getBody(), ['id' => $this->eventId()]);
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
