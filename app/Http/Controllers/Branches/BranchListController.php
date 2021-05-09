<?php

declare(strict_types=1);

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseDTOResource;
use Dogebank\Branches\Application\Create\BranchResponse;
use Dogebank\Branches\Application\Report\BranchReporter;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class BranchListController extends Controller
{
    public function __construct(private BranchReporter $reporter)
    {
    }

    public function __invoke(): AnonymousResourceCollection
    {
        /** @var BranchResponse[] $branches */
        $branches = $this->reporter->__invoke();

        return ResponseDTOResource::collection($branches);
    }
}
