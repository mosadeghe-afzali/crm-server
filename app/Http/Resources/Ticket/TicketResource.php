<?php

namespace App\Http\Resources\Ticket;

use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => [
                'id' => $this->priority?->value,
                'name' => $this->priority?->label(),
            ],
            'status' => [
                'id' => $this->status?->value,
                'name' => $this->status?->label(),
            ],
            'user' => $this->user ? [
                'id' => $this->user->id,
                'full_name' => $this->user->first_name.' '.$this->user->last_name,
                'email' => $this->user->email,
            ] : null,
            'assignee' => $this->assignee ? [
                'id' => $this->assignee->id,
                'full_name' => $this->assignee->first_name.' '.$this->assignee->last_name,
            ] : null,
            'owner' => $this->owner ? [
                'id' => $this->owner->id,
                'full_name' => $this->owner->first_name.' '.$this->owner->last_name,
            ] : null,
            'department' => $this->department_id ? [
                'id' => $this->department_id,
                'name' => $this->department?->name,
            ] : null,
            'category' => $this->category_id ? [
                'id' => $this->category_id,
                'name' => $this->category?->name,
            ] : null,
            'created_at' => $this->created_at ?? null,
            'dates' => [
                // 'created_at' => $this->created_at ? Verta::instance($this->created_at)->format('Y-m-d H:i:s') : null,
                // 'start_at' => $this->start_at ? Verta::instance($this->start_at)->format('Y-m-d H:i:s') : null,
                // 'end_at' => $this->end_at ? Verta::instance($this->end_at)->format('Y-m-d H:i:s') : null,
                // 'completed_at' => $this->completed_at ? Verta::instance($this->completed_at)->format('Y-m-d H:i:s') : null,

                'start_at' => $this->start_at ?? null,
                'end_at' => $this->end_at ?? null,
                'completed_at' => $this->completed_at ?? null,
            ],
            'reply_count' => $this->replies?->count() ?? 0,
            'has_attachments' => $this->files?->count() > 0,
            'files' => $this->files ? $this->files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'file_path' => Storage::url('tickets/'.$file->fileable_id.'/'.$file->name),
                    'file_name' => $file->name,
                ];
            })->toArray() : [],
            'replies' => $this->replies ? $this->replies->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'type' => TicketReply::TICKET_REPLY_TYPE_TEXT[$reply->type],
                    'message' => $reply->message,
                    'user' => $reply->user ? [
                        'id' => $reply->user->id,
                        'full_name' => $reply->user->first_name.' '.$reply->user->last_name,
                        'email' => $reply->user->email,
                    ] : null,
                    'files' => $reply->files ? $reply->files->map(function ($file) {
                        return [
                            'id' => $file->id,
                            'file_path' => Storage::url('tickets/'.$file->fileable_id.'/'.$file->name),
                            'file_name' => $file->name,
                        ];
                    })->toArray() : [],
                    'created_at' => $reply->created_at ?? null,
                    'updated_at' => $reply->updated_at ?? null,
                ];
            })->toArray() : [],
        ];
    }
}
