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

            /*
             * We need an id here becouse there is an entry for each
             * Country - Currency relationships. As, for example
             * URUGUAY have several currencies, and EUR (Euro) have
             * several countries.
             */

            $table->id();
            $table->char('code',3);
            $table->char('number',3);   
            $table->string('name');
            $table->tinyInteger('minor_units');
            $table->string('country_name');

            $table->index('code');
            $table->index('number');
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
