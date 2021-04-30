<?php
declare(strict_types=1);


namespace Dogebank\Shared\Infrastructure\Laravel\Persistence;


use Illuminate\Database\ConnectionInterface;

abstract class BaseMysqlRepository
{
    public function __construct(protected ConnectionInterface $db)
    {
    }
    
    protected function tableName(): string
    {
        return static::TABLE;
    }
}
