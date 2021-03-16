<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    /**
     * @param  Request  $request
     *
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {

        return ProductResource::collection(

            Cache::remember('product' . md5(serialize($request->all())), now()->addMinutes(5), function () use ($request) {

                 return Product::paginate($request->per_page);

             })

        );


    }

}
