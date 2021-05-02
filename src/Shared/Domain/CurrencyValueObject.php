<?php
declare(strict_types=1);


namespace Dogebank\Shared\Domain;


abstract class CurrencyValueObject
{
    public function __construct(private float $value)
    {
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
