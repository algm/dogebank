<?php
declare(strict_types=1);


namespace Dogebank\Branches\Domain;


use Dogebank\Shared\Domain\Bus\Event\BaseDomainEvent;
use Dogebank\Shared\Domain\DomainEvent;

final class BranchCreated extends BaseDomainEvent implements DomainEvent
{

    public function __construct(string $aggregateId, private array $body, string $eventId = null, string $occurredOn = null)
    {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): BaseDomainEvent
    {
        return new BranchCreated($aggregateId, $body,  $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'dogebank.branch.created';
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->aggregateId(),
            'location' => $this->body['location'],
        ];
    }
}
