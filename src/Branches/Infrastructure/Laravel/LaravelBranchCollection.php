<?php
declare(strict_types=1);

namespace Dogebank\Branches\Infrastructure\Laravel;

use Dogebank\Branches\Domain\BranchCollection;
use Illuminate\Support\Collection;

final class LaravelBranchCollection extends Collection implements BranchCollection
{

}
