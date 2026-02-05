<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\V1\PositionService;

class PositionController extends Controller
{
    use ResponseTrait;
    protected $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function index(Request $request)
    {
        $output = $this->positionService->index($request->all());
        return $this->showResponse($output);
    }
}
