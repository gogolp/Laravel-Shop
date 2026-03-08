<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'description'      => $this->description,
            'image_url'        => $this->image_url,
            'price_uah'        => $this->price_uah,
            'price_it_coins'   => $this->price_it_coins,
            'cashback_percent' => $this->cashback_percent,
            'is_active'        => $this->is_active,
            'tag'              => $this->tag,
            'category' => $this->whenLoaded('category', fn() => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ]),
        ];
    }
}
