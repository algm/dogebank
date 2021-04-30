<?php
declare(strict_types=1);


namespace Dogebank\Shared\Domain;


interface DomainEvent
{
    public function eventId(): string;

    public function aggregateId(): string;

    public function toPrimitives(): array;

    public static function eventName(): string;
}
