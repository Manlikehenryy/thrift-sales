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
            $table->foreignId('user_id');
            $table->text('name');
            $table->text('posts');
            $table->integer('price');
            $table->integer('qty');
            $table->text('address');
            $table->string('state');
            $table->string('city');
            $table->integer('amount');
            $table->integer('phone_no');
            $table->string('recipient');
            $table->string('payment_id');
            $table->string('status');
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
