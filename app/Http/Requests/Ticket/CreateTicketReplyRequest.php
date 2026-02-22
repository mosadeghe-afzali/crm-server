<?php

namespace App\Http\Requests\Ticket;

use App\Models\TicketReply;
use Illuminate\Foundation\Http\FormRequest;

class CreateTicketReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['ticket_id' => $this->route('ticket_id')]);

        if ($this->has('type')) {
            $type = $this->type;
            $typeInt = match ($type) {
                'reply' => TicketReply::TYPE_REPLY,
                'comment' => TicketReply::TYPE_COMMENT,
                default => $type,
            };
            $this->merge(['type' => $typeInt]);
        }
    }

    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:tickets,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:1,2',
            'message' => 'required|string|min:1|max:6500',
            'attachments' => 'array',
            'attachments.*' => 'file',
        ];
    }
}
