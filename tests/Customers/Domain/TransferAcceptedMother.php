<?php

declare(strict_types=1);

namespace Tests\Customers\Domain;

use Dogebank\Transfers\Domain\TransferAccepted;
use Illuminate\Support\Str;
use Tests\Shared\Domain\ObjectMother;
use Tests\Transfers\Domain\TransferAmountMother;

final class TransferAcceptedMother extends ObjectMother
{
    public static function create(
        ?string $id = null,
        ?string $from = null,
        ?string $to = null,
        float $amount = null
    ): TransferAccepted {
        return new TransferAccepted(
            $id ?? Str::uuid()->toString(),
            [
                'from' => $from ?? CustomerIdMother::create()->getValue(),
                'to' => $to ?? CustomerIdMother::create()->getValue(),
                'amount' => $amount ?? TransferAmountMother::create()->getValue(),
            ]
        );
    }
}
