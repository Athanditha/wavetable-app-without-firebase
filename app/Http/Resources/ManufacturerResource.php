<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManufacturerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact_name' => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

