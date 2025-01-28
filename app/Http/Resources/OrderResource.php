<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'total' => $this->total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'customer' => $this->whenLoaded('customer'), // Eager load customer
            'order_items' => $this->whenLoaded('orderItems'), // Eager load order items
        ];
    }
}
