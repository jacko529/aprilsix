<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerSaleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'order_number' => $this->order_number,
            'customer_ref' => $this->customer_ref,
            'part_number' => $this->part_number,
            'date' => $this->date,
        ];
    }
}
