<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price_at_moment' => $this->price_at_moment,
            'product' => $this->whenLoaded('product', fn() => [
                'name' => $this->product->name,
                'image_url' => $this->product->image_url,
                'price_it_coins' => $this->product->price_it_coins,
            ]),
        ];
    }
}

