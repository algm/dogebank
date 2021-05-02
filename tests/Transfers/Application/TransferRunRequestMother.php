<?php
declare(strict_types=1);

namespace Tests\Transfers\Application;

use Dogebank\Transfers\Application\Run\TransferRunRequest;
use Illuminate\Support\Str;
use Tests\Customers\Domain\CustomerIdMother;
use Tests\Shared\Domain\ObjectMother;

final class TransferRunRequestMother extends ObjectMother
{
    public static function create(
        ?string $id = null,
        ?string $from = null,
        ?string $to = null,
        ?float $amount = null,
    ): TransferRunRequest {
        return new TransferRunRequest(
            $id ?? Str::uuid()->toString(),
            $from ?? CustomerIdMother::create()->getValue(),
            $to ?? CustomerIdMother::create()->getValue(),
            $amount ?? TransferRunRequestMother::generator()->numberBetween(10, 1000)
        );
    }
}
