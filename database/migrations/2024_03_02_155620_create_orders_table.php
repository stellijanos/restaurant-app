<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 32)->nullable(false);
            $table->string('lastname', 32)->nullable(false);
            $table->string('email', 64)->nullable(false);
            $table->string('phone', 15)->nullable(false);
            $table->string('address', 64)->nullable(false);
            $table->string('shipping_fee', 64)->default(0);
            $table->string('status', 64)->default('pending');
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
        Schema::dropIfExists('orders');
    }
};
