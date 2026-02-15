<?php

namespace App\Http\Resources\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $addresses = $this->user->addresses()
            // ->where('status', 1)
            ->get();
        $data = [
            'id' => $this->id,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'mobile' => $this->user->mobile,
            'email' => $this->user->email,
            'gender' => !empty($this->user->gender) ? User::USER_GENDER_TEXT[$this->user->gender] : null,
            'national_code' => $this->user->national_code,
            'last_login' => $this->user->last_login,
            'position_id' => $this->position_id,
            'position_name' => $this->position->name ?? null,
            'internal_code' => $this->internal_code,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name ?? null,
            'user_id' => $this->user->id
        ];

        foreach ($addresses as $address) {
            $data['addresses'][] = [
                'id' => $address->id,
                'address_title' => $address->title,
                'address' => $address->address,
                'city_id' => $address->city_id,
                'postal_code' => $address->postal_code
            ];
        }

        return $data;
    }
}
