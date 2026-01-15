<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
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
            $data = [
                'id' => $item->id,
                'first_name' => $item->user->first_name,
                'last_name' => $item->user->last_name,
                'mobile' => $item->user->mobile,
                'email' => $item->user->email,
                'gender' => !empty($item->user->gender) ? User::USER_GENDER_TEXT[$item->user->gender] : null,
                'national_code' => $item->user->national_code,
                'last_login' => $item->user->last_login,
            ];

            if($item->type == 2) { #company
                $data['company_name'] = $item->company->company_name;
                $data['registeration_date'] = $item->company->registeration_date;
                $data['national_id'] = $item->company->national_id;
            }

            return $data;
        });
    }
}
