<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id',
        'type',
        'user_id',
        'message',
    ];

    const TICKET_REPLY_TYPE_TEXT = [
        self::TYPE_REPLY => 'پاسخ',
        self::TYPE_COMMENT => 'کامنت'
    ];

    const USER_STATUSES_ENUM = [
        self::TYPE_REPLY => 'reply',
        self::TYPE_COMMENT => 'comment'
    ];

    const TYPE_COMMENT = 2;
    const TYPE_REPLY = 1;
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
