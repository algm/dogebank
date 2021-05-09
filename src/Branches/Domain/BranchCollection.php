<?php
declare(strict_types=1);

namespace Dogebank\Branches\Domain;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Traversable;

interface BranchCollection extends Traversable, Arrayable, JsonSerializable
{
    public static function make($items = []);

    public function map(callable $callback);

    public function merge($items);
}
