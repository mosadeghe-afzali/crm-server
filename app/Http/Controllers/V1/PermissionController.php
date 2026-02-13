<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\V1\PermissionService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\User\Permission\AssignRolePermissionRequest;

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
            throw ValidationException::withMessages(['name' => __("messages.public.error.required", ['pattern' => 'نام'])]);
        }
        $input = [
            'name' => $request->name
        ];
        $this->permissionService->store($input);
        return $this->showResponse();
    }

    public function roleStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(['name' => __("messages.public.error.required", ['pattern' => 'نام'])]);
        }
        $input = [
            'name' => $request->name
        ];
        $this->permissionService->roleStore($input);
        return $this->showResponse();
    }

    public function roleIndex()
    {
        $output = $this->permissionService->roleIndex();
        return $this->showResponse($output);
    }

    public function index()
    {
        $output = $this->permissionService->index();
        return $this->showResponse($output);
    }

    public function rolePermissions($role_id)
    {
        $output = $this->permissionService->rolePermissions($role_id);
        return $this->showResponse($output);
    }

    public function assignrolePermissions(AssignRolePermissionRequest $request)
    {
        $input = $request->validated();
        $output = $this->permissionService->assignrolePermissions($input);
        return $this->showResponse($output);
    }
}
