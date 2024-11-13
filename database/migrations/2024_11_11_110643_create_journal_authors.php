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
        Schema::create('journal_authors', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('name');
            $table->string('designation');
            $table->string('organization');
            $table->string('email');
            $table->string('mobile');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('postalCode');
            $table->integer('main');
            $table->string("journal_id");
            $table->foreign('journal_id')->references('id')->on('journal')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('journal_authors');
    }
};
