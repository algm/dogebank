<?php
declare(strict_types=1);


namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseDTOResource;
use Dogebank\Branches\Application\Report\TopBranchesReporter;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class BranchTopListController extends Controller
{
    public function __construct(private TopBranchesReporter $reporter)
    {
    }

    public function __invoke(): AnonymousResourceCollection
    {
        $branches = $this->reporter->__invoke();

        return ResponseDTOResource::collection($branches);
    }
}
