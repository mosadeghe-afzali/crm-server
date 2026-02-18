<?php

namespace App\Services\V1;

use App\Repositories\TicketReplyRepository;
use App\Repositories\TicketRepository;

class TicketService
{
    private $ticketRepository;

    private $ticketReplyRepository;

    public function __construct(
        TicketRepository $ticketRepository,
        TicketReplyRepository $ticketReplyRepository,

    ) {
        $this->ticketRepository = $ticketRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    public function create($input)
    {
        $ticket = $this->ticketRepository->create([
            'title' => $input['title'],
            'description' => $input['description'],
            'user_id' => $input['user_id'],
            'owner_id' => $input['owner_id'] ?? $input['user_id'],
            'assignee_id' => $input['assignee_id'] ?? null,
            'department_id' => $input['department_id'],
            'priority' => $input['priority'],
            'start_at' => $input['start_at'] ?? null,
            'end_at' => $input['end_at'] ?? null,
            'category_Id' => $input['category_Id'] ?? 1,
            'status' => 1,
        ]);

        if (! empty($input['attachments'])) {

        }
    }

    public function show($input)
    {
        return $this->ticketRepository->show($input);
    }

    public function index()
    {
        return $this->ticketRepository->index();
    }

    public function update($input)
    {
        return $this->ticketRepository->update($input);
    }

    public function priorities()
    {
        return $this->ticketRepository->priorities();
    }

    public function statuses()
    {
        return $this->ticketRepository->statuses();
    }
}
