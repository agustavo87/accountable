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
        Schema::create('iso_currencies', function (Blueprint $table) {

            $table->char('code',3);
            $table->integer('number');   
            $table->string('name');
            $table->tinyInteger('minor_units');
            $table->string('symbol');
            $table->unique('code');
            $table->unique('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iso_currencies');
    }
};
