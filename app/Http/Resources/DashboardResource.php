<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
            'worst_product' => $this->resource['worst_product'],
            'top_product' => $this->resource['top_product'],
            'chart_data' => $this->resource['chart']
        ];
    }
}
