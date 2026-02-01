<?php

namespace App\Http\Resources\Ticket;

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
        // return parent::toArray($request);
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'priority' => $item->,
                'status' => $item->user->email,
                'user_id' => !empty($item->user->gender) ? User::USER_GENDER_TEXT[$item->user->gender] : null,
                'assignee_id' => $item->user->national_code,
                'user_name_family' => $item->position_id,
                'assignee_name_family' => $item->position->name ?? null,
                'department_id' => $item->user->last_login,
                'department_name' => $item->internal_code,
            ];
        });
    }
}
