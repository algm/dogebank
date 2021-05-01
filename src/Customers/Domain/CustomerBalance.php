<?php

namespace Dogebank\Customers\Domain;

class CustomerBalance
{
    public function __construct(private float $value)
    {
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
