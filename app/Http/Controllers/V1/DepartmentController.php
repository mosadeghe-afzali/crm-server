<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\V1\DepartmentService;

class DepartmentController extends Controller
{
    use ResponseTrait;
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request)
    {
        $output = $this->departmentService->index($request->all());
        return $this->showResponse($output);
    }
}
