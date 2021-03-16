<?php


namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;
use App\Models\CustomerSale;

class Dashboard implements  Arrayable
{

    protected array $chartData ;
    protected CustomerSale|array $topProduct;
    protected CustomerSale|array $worstProduct;


    public function stats()
    {

        $this->topProduct = $this->topProduct() ?? [];
        $this->worstProduct = $this->worstProduct() ?? [];
        $this->chartData = $this->chartData();

        return $this->toArray();
    }


    protected function chartData()
    {


        $chartData = CustomerSale::chartByMonth()->get();

        $labels = $chartData->map(function ($labels) {

           return $labels->month;

        });

        $occurrences = $chartData->map(function ($occurrences) {

            return $occurrences->occurrences;

        });


        return [
            'data' => $occurrences->toArray(),
            'labels' => $labels->toArray()
        ];

    }

    protected function worstProduct()
    {

        return CustomerSale::worstProduct()
                           ->get()
                           ->first();

    }

    protected function topProduct()
    {

        return CustomerSale::topProduct()
                           ->get()
                           ->first();

    }

    public function toArray()
    {

        return [

            'chart' => $this->chartData,
            'top_product' => $this->topProduct,
            'worst_product' => $this->worstProduct

        ];

    }
}
