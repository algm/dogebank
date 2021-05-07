<?php

declare(strict_types=1);

namespace Tests;

use Dogebank\Shared\Domain\Bus\Event\EventBus;
use Illuminate\Support\Arr;
use Mockery\MockInterface;

abstract class UseCaseTestCase extends TestCase
{
    protected function shouldPublishEvents(string ...$eventClassNames): MockInterface
    {
        return $this->mock(EventBus::class, function (MockInterface $mock) use ($eventClassNames) {
            $mock->shouldReceive('publish')->withArgs(function (...$args) use ($eventClassNames) {
                $foundCount = 0;
                foreach ($eventClassNames as $eventClassName) {
                    $found = Arr::first($args, fn ($arg) => get_class($arg) === $eventClassName);

                    if (!empty($found)) {
                        ++$foundCount;
                    }
                }

                return $foundCount === count($eventClassNames);
            });
        });
    }
}
