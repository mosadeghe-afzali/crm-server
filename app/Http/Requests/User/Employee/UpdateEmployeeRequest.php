<?php

namespace App\Http\Requests\User\Employee;

use App\Rules\MobileRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
        $this->merge(['employee_id' => $this->route('employee_id')]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "employee_id" => 'required|exists:employees,id',
            'user_id' => 'required|exists:users,id',
            'first_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'last_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'mobile' => ['required', 'string', new MobileRule(), Rule::unique('users')->ignore($this->user_id)],
            'birth_date' => 'nullable|date_format:Y-m-d',
            'email' => ['email', Rule::unique('users')->ignore($this->user_id)],
            'gender' => 'nullable|integer',
            'national_code' => 'string',
            'position_id' => 'exists:positions,id',
            'internal_code' => 'string',
            'department_id' => 'exists:departments,id',
            'address' => 'array',
            'address.address_id' => 'nullable|exists:addresses,id',
            // 'address.province_id' => 'exists:provinces,id',
            'address.city_id' => 'nullable|required_with:address|exists:cities,id',
            'address.address' => 'nullable|required_with:address|string|min:3',
            'address.postal_code' => 'nullable|string|digits:10',
            'address.title' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'address.address' =>  'آدرس',
            'address.city_id' => 'شهر',
            'address.province_id' => 'استان',
            'address.title' => 'نام آدرس',
            'address.postal_code' => 'کد پستی'
        ];
    }
}
