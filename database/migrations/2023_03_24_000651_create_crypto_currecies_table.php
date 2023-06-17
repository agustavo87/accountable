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
        Schema::create('crypto_currencies', function (Blueprint $table) {
            $table->string('code');
            $table->bigInteger('numeric_code');
            $table->string('name');
            $table->tinyInteger('minor_units');

            $table->unique('code');
            $table->unique('numeric_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crypto_currecies');
    }
};
