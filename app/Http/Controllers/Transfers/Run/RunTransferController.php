<?php
declare(strict_types=1);


namespace App\Http\Controllers\Transfers\Run;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseDTOResource;
use Dogebank\Transfers\Application\Run\TransferRunner;
use Dogebank\Transfers\Application\Run\TransferRunRequest;
use Illuminate\Http\Request;

final class RunTransferController extends Controller
{
    public function __construct(private TransferRunner $transferRunner)
    {
    }

    public function __invoke(Request $request): ResponseDTOResource
    {
        $runRequest = TransferRunRequest::fromArray($request->only(['id', 'from', 'to', 'amount']));

        $response = $this->transferRunner->__invoke($runRequest);

        return ResponseDTOResource::make($response);
    }
}
