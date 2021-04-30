<?php
declare(strict_types=1);


namespace Dogebank\Shared\Infrastructure\Laravel\Bus;


use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Dogebank\Shared\Domain\DomainEvent;
use Illuminate\Events\Dispatcher;
use Psr\Log\LoggerInterface;

final class LaravelEventBus implements EventBus
{
    public function __construct(private Dispatcher $eventDispatcher, private LoggerInterface $logger)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->eventDispatcher->dispatch($event);
            $this->logEvent($event);
        }
    }

    /**
     * @param DomainEvent $event
     */
    public function logEvent(DomainEvent $event): void
    {
        $this->logger->info($event::eventName(), array_merge([
            'event_id' => $event->eventId(),
            'id' => $event->aggregateId(),
            'primitives' => $event->toPrimitives()
        ]));
    }

}
