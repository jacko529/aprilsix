<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CustomerSale;

class DashboardEndpointTest extends TestCase
{

    use RefreshDatabase;



    public function test_dashboard_endpoint()
    {
        CustomerSale::factory(15)
                    ->create();


        $response = $this->get('/api/aprilsix/dashboard');

        $response->assertJsonStructure(['data' => ['worst_product', 'top_product', 'chart_data']], $response->json());

    }
}
