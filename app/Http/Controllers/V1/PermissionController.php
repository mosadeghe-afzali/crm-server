<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\PermissionService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PermissionController extends Controller
{
    use ResponseTrait;
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(__("messages.public.error.required", ['pattern' => 'نام']));
        }
        $input = [
            'name' => $request->name
        ];
        $this->permissionService->store($input);
        return $this->showResponse();
    }

    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(__("messages.public.error.required", ['pattern' => 'نام']));
        }
        $input = [
            'name' => $request->name
        ]; 
        $this->permissionService->storeRole($input);
        return $this->showResponse();
    }
}
