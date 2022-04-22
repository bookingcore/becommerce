<?php


namespace Modules\User\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'country' => $this->country,
            'phone' => $this->phone,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'company' => $this->company,
            'postcode' => $this->postcode,
        ];
    }
}
