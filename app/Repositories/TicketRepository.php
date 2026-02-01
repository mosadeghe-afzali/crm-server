<?php
namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository {
    public function index($input) {
        return Ticket::with('replies', 'files')->filter($input)->paginate(10);
    }

    public function show($input) {
        return Ticket::with('replies', 'files')->filter($input)->first();
    }

    public function create($input) {
        return Ticket::create($input);
    }

    public function find($ticket_id) {
        return Ticket::find($ticket_id);
    }

    public function update($input) {

        $ticket_id = $input['ticket_id'];
        unset($input['ticket_id']);

        Ticket::where('id', $ticket_id)->update($input);
    }
}
