<?php

namespace App\Http\Resources\Ticket;

// use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $this->truncateDescription($item->description),
                'priority' => [
                    'id' => $item->priority?->value,
                    'name' => $item->priority?->label(),
                ],
                'status' => [
                    'id' => $item->status?->value,
                    'name' => $item->status?->label(),
                ],
                'user' => $item->user ? [
                    'id' => $item->user->id,
                    'full_name' => $item->user->first_name . ' ' . $item->user->last_name,
                    'email' => $item->user->email,
                ] : null,
                'assignee' => $item->assignee ? [
                    'id' => $item->assignee->id,
                    'full_name' => $item->assignee->first_name . ' ' . $item->assignee->last_name,
                ] : null,
                'owner' => $item->owner ? [
                    'id' => $item->owner->id,
                    'full_name' => $item->owner->first_name . ' ' . $item->owner->last_name,
                ] : null,
                'department' => $item->department_id ? [
                    'id' => $item->department_id,
                    'name' => $item->department?->name,
                ] : null,
                'category' => $item->category_id ? [
                    'id' => $item->category_id,
                    'name' => $item->category?->name,
                ] : null,
                'created_at' => $item->created_at ?? null,
                'dates' => [
                    // 'created_at' => $item->created_at ? Verta::instance($item->created_at)->format('Y-m-d H:i:s') : null,
                    // 'start_at' => $item->start_at ? Verta::instance($item->start_at)->format('Y-m-d H:i:s') : null,
                    // 'end_at' => $item->end_at ? Verta::instance($item->end_at)->format('Y-m-d H:i:s') : null,
                    // 'completed_at' => $item->completed_at ? Verta::instance($item->completed_at)->format('Y-m-d H:i:s') : null,

                    'start_at' => $item->start_at ?? null,
                    'end_at' => $item->end_at ?? null,
                    'completed_at' => $item->completed_at ?? null,
                ],
                'reply_count' => $item->replies?->count() ?? 0,
                'has_attachments' => $item->files?->count() > 0,
            ];
        });
    }

    /**
     * Truncate description to specified length
     */
    private function truncateDescription(?string $description, int $length = 100): ?string
    {
        if (empty($description)) {
            return null;
        }

        if (mb_strlen($description) <= $length) {
            return $description;
        }

        return mb_substr($description, 0, $length) . '...';
    }
}
