<?php

namespace App\Http\Controllers;

use App\Models\CustomerSale;
use App\Http\Resources\CustomerSaleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CustomerSaleController extends Controller
{

    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request) : AnonymousResourceCollection
    {

        return CustomerSaleResource::collection(

            Cache::remember('customer-sale' . md5(serialize($request->all())), now()->addMinutes(10), function () use ($request){

                return CustomerSale::paginate($request->per_page);

            })

        );
    }

}
