<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'item_amt' => $this->item_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'items' => ItemResource::collection($this->whenLoaded('items'))
        ];
    }
} 