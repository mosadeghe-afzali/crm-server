<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MobileRule;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        return $this->merge(['type_name' => $this->route('type_name')]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_name' => 'required|exists:user_types,slug',
            'first_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'last_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'mobile' => ['required', 'string', new MobileRule(), Rule::unique('users')],
            'birth_date' => 'nullable|date_format:Y-m-d',
            'email' => 'email',
            'password' => 'required|min:8',
            'gender' => 'nullable|integer',
            'national_code' => 'string',
            'customer_type' => 'required_if:type_name,customer|in:1,2',
            'national_id' => 'nullable|required_if:customer_type,2|digits:10',
            'registeration_date' => 'nullable|required_if:customer_type,2,date',
            'company_name' => 'nullable|required_if:customer_type,2|string|min:2|max:100',
            'position' => 'required_if:type_name,employee',
            'internal_code' => 'required_if:type_name,employee',
            'department_id' => 'required_if:type_name,employee'
        ];
    }
}
