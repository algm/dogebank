<?php
declare(strict_types=1);


namespace Dogebank\Customers\Infrastructure;

use Dogebank\Customers\Domain\CustomerCollection;
use Illuminate\Support\Collection;

final class LaravelCustomerCollection extends Collection implements CustomerCollection
{

}
