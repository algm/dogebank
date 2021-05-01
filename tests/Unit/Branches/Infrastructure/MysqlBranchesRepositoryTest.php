<?php

namespace Tests\Unit\Branches\Infrastructure;

use Dogebank\Branches\Infrastructure\Laravel\Persistence\MysqlBranchesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Branches\Domain\BranchIdMother;
use Tests\Branches\Domain\BranchLocationMother;
use Tests\Branches\Domain\BranchMother;
use Tests\TestCase;

class MysqlBranchesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testSavesBranches()
    {
        $id = BranchIdMother::create();
        $branch = BranchMother::create($id);

        $this->getRepository()->save($branch);

        $this->assertDatabaseHas(MysqlBranchesRepository::TABLE, [
            'id' => $id->getValue(),
        ]);
    }

    public function testFindsBranches()
    {
        $id = BranchIdMother::create();
        DB::table(MysqlBranchesRepository::TABLE)->insert([
            'id' => $id->getValue(),
            'location' => BranchLocationMother::create()->getValue(),
        ]);

        $branch = $this->getRepository()->find($id);

        $this->assertEquals($branch->getId()->getValue(), $id->getValue());
    }

    public function getRepository(): MysqlBranchesRepository
    {
        return $this->app->get(MysqlBranchesRepository::class);
    }
}
