<?php
declare(strict_types=1);


namespace Dogebank\Shared\Domain;


abstract class AggregateRoot
{
    private array $eventRegistry = [];

    /**
     * Records a domain event
     *
     * @param DomainEvent $event
     */
    public function recordThat(DomainEvent $event): void
    {
        $this->eventRegistry[] = $event;
    }

    /**
     * Returns registered domain events for the aggregate
     *
     * @return array
     */
    public function pullEvents(): array
    {
        return $this->eventRegistry;
    }
}
