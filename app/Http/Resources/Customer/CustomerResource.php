<?php

namespace App\Http\Resources\Customer;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'gender' => [
                'id' => $this->user->gender,
                'name' => !empty($this->user->gender) ? User::USER_GENDER_TEXT[$this->user->gender] : null,
            ],
            'national_code' => $this->user->national_code,
            'last_login' => $this->user->last_login,
            'user_id' => $this->user->id,
            'type' => [
                'id' => $this->type,
                'name' => Customer::CUSTOMER_TYPES_TEXT[$this->type]
            ]
        ];
        foreach ($addresses as $address) {
            $data['addresses'][] = [
                'id' => $address->id,
                'address_title' => $address->title,
                'address' => $address->address,
                'city' => [
                    'id' => $address->city_id,
                    'name' => $address->city->name
                ],
                'postal_code' => $address->postal_code
            ];
        }

        if ($this->type == 2) { #company
            $data['compnay']['id'] = $this->company->id;
            $data['compnay']['company_name'] = $this->company->company_name;
            $data['compnay']['registeration_date'] = $this->company->registeration_date;
            $data['compnay']['national_id'] = $this->company->national_id;
        }

        return $data;
    }
}
