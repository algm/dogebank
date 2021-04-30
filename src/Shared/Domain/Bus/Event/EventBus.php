<?php


namespace Dogebank\Shared\Domain\Bus\Event;


use Dogebank\Shared\Domain\DomainEvent;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}
