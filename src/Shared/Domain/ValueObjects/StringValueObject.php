<?php
declare(strict_types=1);


namespace Dogebank\Shared\Domain\ValueObjects;


use Stringable;

abstract class StringValueObject implements Stringable
{
    public function __construct(private string $value)
    {
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
