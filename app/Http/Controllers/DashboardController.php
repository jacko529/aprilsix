<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Entities\Dashboard;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    /**
     * As there is only one method - single action controller was used
     *
     * @param  Dashboard  $dashboard
     *
     * @return DashboardResource
     *
     */
    public function __invoke(Dashboard $dashboard) : DashboardResource
    {

        return DashboardResource::make(

            Cache::remember('dashboard', now()->addMinutes(10), function () use ($dashboard) {

                return $dashboard->stats();

            })

        );

    }

}
