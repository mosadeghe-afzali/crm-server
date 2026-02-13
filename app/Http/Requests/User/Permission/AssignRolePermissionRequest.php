<?php

namespace App\Http\Requests\User\Permission;

use Illuminate\Foundation\Http\FormRequest;

class AssignRolePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['role_id' => $this->route('role_id')]);
        $this->merge(['permission_id' => $this->route('permission_id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "role_id" => 'required|exists:roles,id',
            "permission_id" => 'required|exists:permissions,id'
        ];
    }
}
