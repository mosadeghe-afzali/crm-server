<?php
namespace App\Repositories;

use App\Models\TicketReply;

class TicketReplyRepository {
    public function index($input) {
        return TicketReply::filter($input)->paginate(10);
    }
    public function show($input) {
        return TicketReply::filter($input)->first();
    }

    public function create($input) {
        return TicketReply::create($input);
    }

    public function find($reply_id) {
        return TicketReply::find($reply_id);
    }

    public function update($input) {

        $reply_id = $input['reply_id'];
        unset($input['reply_id']);

        TicketReply::where('id', $reply_id)->update($input);
    }
}
