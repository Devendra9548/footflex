<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderid')->unique();
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('customers')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('phonenumber')->nullable();
            $table->longText('address')->nullable();
            $table->longText('altaddress')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->unsignedBigInteger('zip')->nullable();
            $table->string('paymethod')->nullable();
            $table->longText('cart')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
