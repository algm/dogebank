<?php

declare(strict_types=1);

namespace Tests\Feature\Transfers;

use Illuminate\Support\Str;
use Tests\Shared\Infrastructure\ApiTestCase;

final class RunTransferTest extends ApiTestCase
{
    public function testCanRunTransfersBetweenCustomers()
    {
        $customer1 = $this->generateSavedCustomerWithBalance(1000);
        $customer2 = $this->generateSavedCustomerWithBalance();
        $trxId = Str::uuid()->toString();

        $postData = [
            'id' => $trxId,
            'from' => $customer1->getId()->getValue(),
            'to' => $customer2->getId()->getValue(),
            'amount' => 100,
        ];

        $this->json('post', '/api/transfers', $postData)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $trxId,
                    'from' => $customer1->getId()->getValue(),
                    'to' => $customer2->getId()->getValue(),
                    'amount' => 100,
                    'status' => 'OK',
                    'reason' => '',
                ],
            ]);
    }

    public function testTransfersAreRejectedWhenCustomerDoesNotHaveEnoughBalance()
    {
        $customer1 = $this->generateSavedCustomerWithBalance(1000);
        $customer2 = $this->generateSavedCustomerWithBalance();
        $trxId = Str::uuid()->toString();

        $postData = [
            'id' => $trxId,
            'from' => $customer1->getId()->getValue(),
            'to' => $customer2->getId()->getValue(),
            'amount' => 10000,
        ];

        $this->json('post', '/api/transfers', $postData)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $trxId,
                    'from' => $customer1->getId()->getValue(),
                    'to' => $customer2->getId()->getValue(),
                    'amount' => 10000,
                    'status' => 'REJECTED',
                    'reason' => 'INSUFFICIENT_FUNDS',
                ],
            ]);
    }
}
