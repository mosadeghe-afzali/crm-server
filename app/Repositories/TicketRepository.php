<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Enums\TicketStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Http\Resources\Ticket\TicketCollection;
use App\Http\Resources\Ticket\TicketResource;

class TicketRepository
{
    public function index($input)
    {
        $tickets = Ticket::with('replies', 'files')->filter($input)->paginate(10);
        return new TicketCollection($tickets);
    }

    public function show($input)
    {
        $ticket = Ticket::with('replies', 'files')->filter($input)->first();
        return new TicketResource($ticket);
    }

    public function create($input)
    {
        return Ticket::create($input);
    }

    public function find($ticket_id)
    {
        return Ticket::find($ticket_id);
    }

    public function update($input)
    {

        $ticket_id = $input['ticket_id'];
        unset($input['ticket_id']);

        Ticket::where('id', $ticket_id)->update($input);
    }

    public function priorities()
    {
        return [
            ['id' => TicketPriorityEnum::LOW->value, 'name' => TicketPriorityEnum::LOW->label()],
            ['id' => TicketPriorityEnum::INTERMEDIATE->value, 'name' => TicketPriorityEnum::INTERMEDIATE->label()],
            ['id' => TicketPriorityEnum::HIGH->value, 'name' => TicketPriorityEnum::HIGH->label()],
        ];
    }

    public function statuses()
    {
        return [
            ['id' => TicketStatusEnum::PENDING_RESPONSE->value, 'name' => TicketStatusEnum::PENDING_RESPONSE->label()],
            ['id' => TicketStatusEnum::IN_PROGRESS->value, 'name' => TicketStatusEnum::IN_PROGRESS->label()],
            ['id' => TicketStatusEnum::RESPONDED->value, 'name' => TicketStatusEnum::RESPONDED->label()],
            ['id' => TicketStatusEnum::CLOSED->value, 'name' => TicketStatusEnum::CLOSED->label()],
        ];
    }
}
