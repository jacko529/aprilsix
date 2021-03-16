<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request) : AnonymousResourceCollection
    {

        return CustomerResource::collection(

            Cache::remember('customer' .md5(serialize($request->all())), now()->addMinutes(10), function () use ($request) {

                return Customer::paginate($request->per_page);

            })

        );

    }

}
