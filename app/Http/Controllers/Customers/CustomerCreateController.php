<?php


namespace App\Http\Controllers\Customers;


use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseDTOResource;
use Dogebank\Customers\Application\Create\CustomerCreateRequest;
use Dogebank\Customers\Application\Create\CustomerCreator;
use Illuminate\Http\Request;

class CustomerCreateController extends Controller
{
    public function __construct(private CustomerCreator $creator)
    {
    }

    public function __invoke(Request $request)
    {
        $createRequest = CustomerCreateRequest::fromArray(
            $request->only(['id', 'branchId', 'name', 'balance'])
        );

        $response = $this->creator->__invoke($createRequest);

        return ResponseDTOResource::make($response);
    }
}
