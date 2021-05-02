<?php
declare(strict_types=1);

namespace Tests\Unit\Customers\Infrastructure;

use Dogebank\Customers\Infrastructure\Persistence\MysqlCustomersRepository;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Branches\Domain\BranchIdMother;
use Tests\Customers\Domain\CustomerBalanceMother;
use Tests\Customers\Domain\CustomerIdMother;
use Tests\Customers\Domain\CustomerMother;
use Tests\Customers\Domain\CustomerNameMother;
use Tests\TestCase;

final class MysqlCustomersRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Connection $connection */
        $connection = DB::connection();

        $connection->getSchemaBuilder()->disableForeignKeyConstraints();
    }

    public function testSavesCustomers()
    {
        $id = CustomerIdMother::create();
        $customer = CustomerMother::create(id: $id);

        $this->getRepository()->save($customer);

        $this->assertDatabaseHas(MysqlCustomersRepository::TABLE, [
            'id' => $id->getValue(),
        ]);
    }

    public function testFindsCustomers()
    {

        $id = CustomerIdMother::create();
        DB::table(MysqlCustomersRepository::TABLE)->insert([
            'id' => $id->getValue(),
            'branch_id' => BranchIdMother::create()->getValue(),
            'name' => CustomerNameMother::create()->getValue(),
            'balance' => CustomerBalanceMother::create()->getValue(),
        ]);

        $branch = $this->getRepository()->find($id);

        $this->assertEquals($branch->getId()->getValue(), $id->getValue());
    }

    public function getRepository(): MysqlCustomersRepository
    {
        return $this->app->get(MysqlCustomersRepository::class);
    }
}
