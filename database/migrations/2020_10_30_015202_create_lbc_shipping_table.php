<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLbcShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbc_shipping', function (Blueprint $table) {
            $table->increments('lbc_shipping_id');
            $table->string('destination');
            $table->integer('1KG');
            $table->integer('3KG');
            $table->integer('5KG');
            $table->integer('10KG');
            $table->integer('20KG');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lbc_shipping');
    }
}
