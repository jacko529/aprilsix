<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CustomerSale::factory()
                            ->times(1)
                            ->create();
    }
}
