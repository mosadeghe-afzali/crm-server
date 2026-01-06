<?php

namespace App\Http\Requests\User\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|in:1,2',
            'first_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'last_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u'],
            'mobile' => ['required', 'string', new MobileRule(), Rule::unique('users')],
            'birth_date' => 'nullable|date_format:Y-m-d',
            'email' => 'required|email',
            'gender' => 'required|integer',
            'national_code' => 'required|string',
            'national_id' => 'nullable|required_if:type,2|digits:10',
            'registeration_date' => 'nullable|required_if:type,2,date',
            'company_name' => 'nullable|required_if:type,2|string|min:2|max:100',
        ];
    }
}
