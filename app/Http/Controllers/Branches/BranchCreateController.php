<?php
declare(strict_types=1);


namespace App\Http\Controllers\Branches;


use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseDTOResource;
use Dogebank\Branches\Application\Create\BranchCreateRequest;
use Dogebank\Branches\Application\Create\BranchCreator;
use Illuminate\Http\Request;

final class BranchCreateController extends Controller
{
    public function __construct(private BranchCreator $branchCreator)
    {
    }

    public function __invoke(Request $request)
    {
        $createRequest = BranchCreateRequest::fromArray($request->only(['id', 'location']));

        return ResponseDTOResource::make($this->branchCreator->__invoke($createRequest));
    }
}
