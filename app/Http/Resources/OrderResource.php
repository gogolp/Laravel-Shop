<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'total_amount_uah' => $this->total_amount_uah,
            'total_amount_coins' => $this->total_amount_coins,
            'location_id' => $this->location_id,
            'location_name' => $this->whenLoaded('location', fn() => $this->location->name),
            'created_at' => $this->created_at->format('d.m.Y H:i'),
            'items' => OrderItemResource::collection(
                $this->whenLoaded('items')
            ),
        ];
    }
}

