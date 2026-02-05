<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\V1\GeneralService;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{

    use ResponseTrait;
    protected $generalService;

    public function __construct(GeneralService $generalService)
    {
        $this->generalService = $generalService;
    }

    public function cities(Request $request)
    {
        $output = $this->generalService->cities($request->all());
        return $this->showResponse($output);
    }

    public function provinces()
    {
        $output = $this->generalService->provinces();
        return $this->showResponse($output);
    }
}
