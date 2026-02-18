<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Services\V1\TicketService;
use App\Traits\ResponseTrait;

class TicketController extends Controller
{
    use ResponseTrait;

    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index()
    {

        $output = $this->ticketService->index();

        return $this->showResponse($output);
    }

    public function show($ticket_id)
    {
        $output = $this->ticketService->show();

        return $this->showResponse($output);
    }

    public function create(CreateTicketRequest $request)
    {
        $input = $request->validated();
        $this->ticketService->create($input);

        $this->showResponse();
    }

    public function update(UpdateTicketRequest $request)
    {
        $input = $request->validated();
        $this->ticketService->update($input);

        $this->showResponse();
    }

    public function proorities()
    {

        $output = $this->ticketService->priorities();

        return $this->showResponse($output);
    }

    public function statuses()
    {
        $output = $this->ticketService->statuses();

        return $this->showResponse($output);
    }
}
