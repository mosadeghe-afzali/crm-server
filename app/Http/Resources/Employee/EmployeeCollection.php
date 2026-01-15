<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
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
                'first_name' => $item->user->first_name,
                'last_name' => $item->user->last_name,
                'mobile' => $item->user->mobile,
                'email' => $item->user->email,
                'gender' => !empty($item->user->gender) ? User::USER_GENDER_TEXT[$item->user->gender] : null,
                'national_code' => $item->user->national_code,
                'last_login' => $item->user->last_login,
                'position_id' => $item->position_id,
                'position_name' => $item->position->name ?? null,
                'internal_code' => $item->internal_code,
                'department_id' => $item->department_id,
                'department_name' => $item->department->name ?? null
            ];
        });
    }
}
