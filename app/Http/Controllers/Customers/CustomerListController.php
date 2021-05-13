<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseDTOResource;
use Dogebank\Customers\Application\Lists\CustomerList;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class CustomerListController extends Controller
{
    public function __construct(private CustomerList $customerList)
    {
    }

    public function __invoke(): AnonymousResourceCollection
    {
        $customers = $this->customerList->__invoke();

        return ResponseDTOResource::collection($customers);
    }
}
