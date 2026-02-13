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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'last_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'mobile' => ['required', 'string', new MobileRule(), Rule::unique('users')],
            'birth_date' => 'nullable|date_format:Y-m-d',
            'email' => 'email',
            'gender' => 'nullable|integer',
            'national_code' => 'string',
            'position_id' => 'exists:positions,id',
            'internal_code' => 'string',
            'department_id' => 'exists:departments,id',
            'address' => 'array',
            'address.province_id' => 'exists:provinces,id',
            'address.city_id' => 'exists:cities,id',
            'address.address' => 'string|min:3',
            'address.postal_code' => 'nullable|string|digits:10',
            'address.title' => 'nullable|string'
        ];
    }
}
