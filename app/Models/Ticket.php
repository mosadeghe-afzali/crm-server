<?php

namespace App\Models;

use App\Enums\TicketPriorityEnum;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'assignee_id',
        'department_id',
        'priority',
        'start_at',
        'end_at',
        'completed_at',
        'status',
        'category_id',
        'owner_id',
    ];

    protected $casts = [
        'priority' => TicketPriorityEnum::class,
    ];

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function scopeFilter($query, $request)
    {

        $query->when(
            $request['id'] ?? false,
            fn ($query, $request) => $query->where('tickets.id', $request)
        );

        $query->when(
            $request['title'] ?? false,
            fn ($query, $request) => $query->where('title', 'LIKE', '%'.$request.'%')
        );

        $query->when(
            $request['ticket_id'] ?? false,
            fn ($query, $request) => $query->where('tickets.id', $request)
        );

        $query->when(
            $request['department_id'] ?? false,
            fn ($query, $request) => $query->where('department_id', $request)
        );

        $query->when(
            $request['priority'] ?? false,
            fn ($query, $request) => $query->where('priority', $request)
        )->get();
    }
}
