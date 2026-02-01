<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'user_id' => 'exists:users,id',
            'title' => ['required', 'string', 'min:3', 'max:50', 'unique:tickets,title,' . $this->id . ',id,user_id,' . $this->user_id],
            'priority' => 'required|numeric',
            'department_id' => 'required|numeric|exists:departments,id',
            'description' => 'required|string|min:10|max:6500|regex:/^[\p{L}\s\0-9\x{06F0}-\x{06F9}-_\.,،:؟@!?()]+$/u',
            'start_at' => 'nullable|date_format:Y-m-d H:i:s',
            'end_at' => 'nullable|date_format:Y-m-d H:i:s',
            'category_Id' => 'nullable|exists:ticket_categories,id',
            'attachments.*' => 'file'
        ];
    }
}
