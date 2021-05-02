<?php
declare(strict_types=1);


namespace Dogebank\Transfers\Domain;

use Dogebank\Shared\Domain\ValueObjects\StringValueObject;
use InvalidArgumentException;

final class TransferStatus extends StringValueObject
{
    public function __construct(string $value)
    {
        if (!in_array($value, ['OK', 'REJECTED', 'PENDING'])) {
            throw new InvalidArgumentException("$value is not a valid transfer status");
        }

        parent::__construct($value);
    }
}
