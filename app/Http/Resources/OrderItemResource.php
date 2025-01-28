<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'equipment_id' => $this->equipment_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'order' => $this->whenLoaded('order'), // Eager load related order
            'equipment' => $this->whenLoaded('equipment'), // Eager load related equipment
        ];
    }
}
