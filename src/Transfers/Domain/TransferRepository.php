<?php

namespace Dogebank\Transfers\Domain;

interface TransferRepository
{
    public function save(Transfer $transfer): void;

    public function find(TransferId $id): ?Transfer;
}
