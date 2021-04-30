<?php
declare(strict_types=1);


namespace Dogebank\Shared\Domain\ValueObjects;


use Illuminate\Support\Str;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Stringable;

abstract class UuidValueObject implements Stringable
{
    protected string $uuid;

    public function __construct(string $uuid)
    {
        if (!Uuid::isValid($uuid)) {
            throw new InvalidArgumentException("$uuid is not a valid uuid");
        }

        $this->uuid = $uuid;
    }

    public static function random(): static
    {
        return new static(Str::uuid()->toString());
    }

    public function getValue(): string
    {
        return $this->uuid;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
