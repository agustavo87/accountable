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
        Schema::create('countries', function (Blueprint $table) {
            $table->char('alpha_code_2', 2);
            $table->char('alpha_code_3', 3);
            $table->char('numeric_code_3', 3);
            $table->string('common_name');
            $table->string('oficial_name');
            $table->json('native_names');
            $table->json('currencies');

            $table->unique('alpha_code_2'); 
            $table->unique('alpha_code_3'); 
            $table->unique('numeric_code_3'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
