<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Resources\SearchResource;

class SearchController extends Controller
{


    /**
     * @param  SearchRequest  $request
     *
     * @return SearchResource
     */
    public function __invoke(SearchRequest $request): SearchResource
    {
        return SearchResource::make(
        [
            'customer' => Customer::search($request->search),
            'product' => Product::search($request->search)
        ]);

    }

}
