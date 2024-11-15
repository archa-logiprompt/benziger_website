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
        Schema::create('journel_status', function (Blueprint $table) {
            $table->id();
            $table->integer('staffid');
            $table->foreign('staffid')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('journelid');
            $table->foreign('staffid')->references('id')->on('journal')->onDelete('cascade')->onUpdate('cascade');
            $table->string('reason');
            $table->integer('status');
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
        Schema::dropIfExists('journel_status');
    }
};
