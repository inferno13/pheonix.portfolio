<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletPlusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('user');
            $table->decimal('raw_balance', 16, 8)->default(0)->unsigned();
            $table->timestamps();
        });

        Schema::create('wallet_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->nullableMorphs('transaction');
            $table->decimal('amount', 16, 8)->default(0);
            $table->decimal('running_raw_balance', 16, 8)->default(0)->unsigned();
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
        Schema::dropIfExists('wallet_ledgers');
        Schema::dropIfExists('wallets');
    }
}
