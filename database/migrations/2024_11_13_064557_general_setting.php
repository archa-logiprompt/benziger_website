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
     
            Schema::create('general_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('logo', 255)->nullable();
                $table->string('contact', 10)->nullable();
                $table->string('whatsappContact', 10)->nullable();
                $table->string('email', 50)->nullable();
                $table->string('address_line1', 100)->nullable();
                $table->string('address_line2', 100)->nullable();
                $table->string('city', 50)->nullable();
                $table->string('state', 50)->nullable();
                $table->string('country', 50)->nullable();
                $table->integer('postalCode')->nullable(); 
                $table->string('apiKey', 25)->nullable();
                $table->string('apiSecret', 25)->nullable();
                $table->boolean('payment')->nullable();
                $table->string('amount', 25)->nullable();
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
        Schema::dropIfExists('general_settings');
    }
};
