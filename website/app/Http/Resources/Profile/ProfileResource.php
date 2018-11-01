<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'street' => $this->street,
            'parish' => $this->parish,
            'mobile' => $this->mobile,
            'landline' => $this->landline,
            'farm_name' => $this->farm_name,
            'farm_address_steet' => $this->farm_address_steet,
            'farm_address_parish' => $this->farm_address_parish,
            'flock_capacity' => $this->flock_capacity,
            'principal_occupation' => $this->principal_occupation,
            'qualifications' => $this->qualifications,
            'training' => $this->training,
       ];
    }
}
