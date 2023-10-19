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
        Schema::create('deposit_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ticker');
            $table->string('network');
            $table->integer('confirmations');
            $table->double('min_receive');
            $table->double('fee');
            $table->string('logo');
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
        Schema::dropIfExists('deposit_methods');
    }
};
