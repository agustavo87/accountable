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
        Schema::create('country_iso_currency', function (Blueprint $table) {
            /*
            *  iso_currency_code is not unique identifier for the ISO Currency
            *  entry, as the same currency, with the same code, can belong to several
            *  countries, and the official ISO table has an entry for each 
            *  country-currency couple. Therefore it is used an id for identifying 
            *  each pair.
            */
            $table->char('country_code', 2);
            $table->char('iso_currency_code', 3);
            $table->unsignedInteger('iso_currency_id');

            $table->unique(['country_code', 'iso_currency_id']);
            $table->index('iso_currency_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_iso_currency');
    }
};
