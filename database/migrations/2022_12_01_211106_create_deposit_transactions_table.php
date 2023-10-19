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
        Schema::create('deposit_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('dest_tag')->nullable();
            $table->string('westwallet_id')->nullable();
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->double('amount');
            $table->string('address')->nullable();
            $table->unsignedBigInteger('deposit_method_id');
            $table->foreign('deposit_method_id')->references('id')->on('deposit_methods')->onDelete('cascade');
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
        Schema::dropIfExists('deposit_transactions');
    }
};
