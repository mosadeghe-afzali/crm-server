<?php

namespace App\Http\Requests\Ticket;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['ticket_id' => $this->route('ticket_id')]);
    }

    public function rules(): array
    {
        $statuses = implode(',', array_column(TicketStatusEnum::cases(), 'value'));
        $priorities = implode(',', array_column(TicketPriorityEnum::cases(), 'value'));

        return [
            'ticket_id' => 'required|exists:tickets,id',
            'status' => "nullable|in:{$statuses}",
            'priority' => "nullable|in:{$priorities}",
            'end_at' => 'nullable|date',
            'start_at' => 'nullable|date',
            'department_id' => 'nullable|exists:departments,id',
        ];
    }
}
