<?php

namespace Dogebank\Customers\Domain;

use Dogebank\Shared\Domain\Bus\Event\BaseDomainEvent;
use Dogebank\Shared\Domain\DomainEvent;

class CustomerCreated extends BaseDomainEvent implements DomainEvent
{
    public function __construct(string $aggregateId, private array $body, string $eventId = null, string $occurredOn = null)
    {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): BaseDomainEvent {
        return new CustomerCreated($aggregateId, $body, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'dogebank.customer.created';
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
