<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'part_number' => $this->part_number,
            'description' => $this->description,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
        ];
    }
}
