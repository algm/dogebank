<?php

declare(strict_types=1);

namespace Dogebank\Shared\Infrastructure\Laravel\Persistence;

use Illuminate\Database\ConnectionInterface;
use Psr\Container\ContainerInterface;

abstract class BaseMysqlRepository
{
    public function __construct(protected ConnectionInterface $db, protected ContainerInterface $container)
    {
    }

    protected function tableName(): string
    {
        return static::TABLE;
    }
}
