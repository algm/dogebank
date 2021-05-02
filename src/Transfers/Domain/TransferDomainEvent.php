<?php
declare(strict_types=1);


namespace Dogebank\Transfers\Domain;


use Dogebank\Shared\Domain\Bus\Event\BaseDomainEvent;

abstract class TransferDomainEvent extends BaseDomainEvent
{
    public function __construct(
        string $aggregateId,
        private array $body,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): BaseDomainEvent {
        return new TransferRegistered($aggregateId, $body, $eventId, $occurredOn);
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
