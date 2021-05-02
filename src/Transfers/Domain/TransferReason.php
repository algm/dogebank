<?php
declare(strict_types=1);


namespace Dogebank\Transfers\Domain;


use Dogebank\Shared\Domain\ValueObjects\StringValueObject;

final class TransferReason extends StringValueObject
{
    public function __construct(string $value = '')
    {
        parent::__construct($value);
    }
}
