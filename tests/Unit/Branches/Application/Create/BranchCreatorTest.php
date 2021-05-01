<?php

namespace Tests\Unit\Branches\Application\Create;

use Dogebank\Branches\Application\Create\BranchCreator;
use Dogebank\Branches\Domain\BranchesRepository;
use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Tests\Branches\Application\BranchCreateRequestMother;
use Tests\TestCase;

class BranchCreatorTest extends TestCase
{
    public function testCreatesValidBranches()
    {
        $busSpy = $this->spy(EventBus::class);
        $repoSpy = $this->spy(BranchesRepository::class);

        $request = BranchCreateRequestMother::create();

        $response = $this->getService()->__invoke($request);

        $this->assertEquals($response->toArray()['id'], $request->getId());
        $repoSpy->shouldHaveReceived('save');
        $busSpy->shouldHaveReceived('publish');
    }

    protected function getService(): BranchCreator
    {
        return $this->app->get(BranchCreator::class);
    }
}
