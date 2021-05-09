<?php
declare(strict_types=1);


namespace Dogebank\Branches\Domain;

use Dogebank\Shared\Domain\CurrencyValueObject;

final class BranchMaxBalance extends CurrencyValueObject
{
    public function __construct(?float $value = 0)
    {
        parent::__construct($value);
    }
}
