<?php


namespace Dogebank\Customers\Domain;


interface CustomerBalanceUpdatedEvent
{
    public function getBody(): array;
}
