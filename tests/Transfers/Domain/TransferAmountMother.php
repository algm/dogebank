<?php
declare(strict_types=1);


namespace Tests\Transfers\Domain;

use Dogebank\Transfers\Domain\TransferAmount;
use Tests\Shared\Domain\ObjectMother;

final class TransferAmountMother extends ObjectMother
{
    public static function create(?float $amount = null): TransferAmount
    {
        return new TransferAmount($amount ?? TransferAmountMother::generator()->numberBetween(1, 10000));
    }
}
