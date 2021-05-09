<?php

declare(strict_types=1);

namespace Tests\Feature\Branches;

use Dogebank\Branches\Domain\Branch;
use Tests\Shared\Infrastructure\ApiTestCase;

final class ListTopBranchesTest extends ApiTestCase
{
    public function testListsBranchesWithMoreThanTwoCustomersOver50kBalance()
    {
        $branches = $this->generateSavedBranches();

        /** @var Branch $branch1 */
        $branch1 = $branches->get(0);

        /** @var Branch $branch2 */
        $branch2 = $branches->get(3);

        $this->generateSavedCustomerWithBalance(52000, $branch1->getId()->getValue());
        $this->generateSavedCustomerWithBalance(52000, $branch1->getId()->getValue());
        $this->generateSavedCustomerWithBalance(52000, $branch1->getId()->getValue());

        $this->generateSavedCustomerWithBalance(51000, $branch2->getId()->getValue());
        $this->generateSavedCustomerWithBalance(51000, $branch2->getId()->getValue());
        $this->generateSavedCustomerWithBalance(51000, $branch2->getId()->getValue());

        $this->json('get', '/api/branches/top')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJson([
                'data' => [
                    [
                        'id' => $branch1->getId()->getValue(),
                    ],
                    [
                        'id' => $branch2->getId()->getValue(),
                    ],
                ],
            ]);
    }
}
