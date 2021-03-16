<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductsEndPointTest extends TestCase
{

    use RefreshDatabase;


    public function test_paginate_10_per_page()
    {

        Product::factory(15)
               ->create();

        $response = $this->getJson('/api/aprilsix/products');

        $response->assertJsonPath('meta.total', 15);
        $response->assertStatus(200);
    }

    public function test_paginate_1_per_page()
    {

        Product::factory(15)
                 ->create();


        $response = $this->getJson('/api/aprilsix/products?per_page=1');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');

    }

    public function test_paginate_1_per_page_and_second_page()
    {

        Product::factory(15)
                ->create();


        $response = $this->getJson('/api/aprilsix/products?per_page=1&page=2');

        $response->assertJsonPath('meta.total', 15);
        $response->assertJsonPath('meta.current_page', 2);
        $response->assertJsonCount(1, 'data');

    }
}
