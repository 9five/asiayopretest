<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('oid')->unique();
            $table->string('name');
            $table->unsignedBigInteger('address');
            $table->foreign('address')->references('id')->on('address')->onDelete('cascade')->onUpdate('cascade');
            $table->float('price');
            $table->enum('currency', ['TWD', 'USD']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
