<?php

declare(strict_types=1);

namespace Dogebank\Transfers\Infrastructure;

use Dogebank\Shared\Infrastructure\Laravel\Persistence\BaseMysqlRepository;
use Dogebank\Transfers\Domain\Transfer;
use Dogebank\Transfers\Domain\TransferId;
use Dogebank\Transfers\Domain\TransferRepository;

final class MysqlTransferRepository extends BaseMysqlRepository implements TransferRepository
{
    public const TABLE = 'transfers';

    public function save(Transfer $transfer): void
    {
        $this->db->insert(
            "
                INSERT INTO {$this->tableName()} (`id`, `from`, `to`, `amount`, `status`, `reason`)
                       VALUES (?, ?, ?, ?, ?, ?)
            ",
            [
                $transfer->getId()->getValue(),
                $transfer->getFrom()->getValue(),
                $transfer->getTo()->getValue(),
                $transfer->getAmount()->getValue(),
                $transfer->getStatus()->getValue(),
                $transfer->getReason()->getValue() ?? null,
            ]
        );
    }

    public function find(TransferId $id): ?Transfer
    {
        // TODO: Implement find() method.
    }
}
