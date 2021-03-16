<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_number');
            $table->string('customer_ref');
            $table->string('part_number');
            $table->date('date');
            $table->timestamps();

            $table->foreign('customer_ref')->references('ref')->on('customers');
            $table->foreign('part_number')->references('part_number')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
