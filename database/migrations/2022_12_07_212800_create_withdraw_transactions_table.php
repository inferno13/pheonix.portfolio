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
        Schema::create('withdraw_transactions', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->double('westwallet_id')->nullable();
            $table->string('status');
            $table->string('address');
            $table->unsignedBigInteger('deposit_method_id');
            $table->foreign('deposit_method_id')->references('id')->on('deposit_methods')->onDelete('cascade');
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
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
        Schema::dropIfExists('withdraw_transactions');
    }
};
