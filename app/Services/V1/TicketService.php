<?php

namespace App\Services\V1;

use App\Repositories\FileRepository;
use App\Repositories\TicketReplyRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\DB;

class TicketService
{
    private $ticketRepository;

    private $ticketReplyRepository;

    private $fileRepository;

    public function __construct(
        TicketRepository $ticketRepository,
        TicketReplyRepository $ticketReplyRepository,
        FileRepository $fileRepository
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
        $this->fileRepository = $fileRepository;
    }

    public function create($input)
    {
        $ticket = DB::transaction(function () use ($input) {
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
                $this->fileRepository->storeTicketFiles(
                    $ticket,
                    $input['attachments'],
                    $input['user_id']
                );
            }

            return $ticket;
        });

        return $ticket;
    }

    public function show($input)
    {
        return $this->ticketRepository->show($input);
    }

    public function index($input = [])
    {
        return $this->ticketRepository->index($input);
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

    public function reply($input)
    {
        DB::transaction(function () use ($input) {
            $reply = $this->ticketReplyRepository->create([
                'ticket_id' => $input['ticket_id'],
                'user_id' => $input['user_id'],
                'type' => $input['type'],
                'message' => $input['message'],
            ]);

            if (! empty($input['attachments'])) {
                $this->fileRepository->storeTicketFiles(
                    $reply,
                    $input['attachments'],
                    $input['user_id']
                );
            }
        });
    }

    public function report()
    {
        return $this->ticketRepository->report();
    }
}
