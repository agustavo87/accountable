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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('code', 3);
            $table->string('name');
            $table->string('symbol')->default('$');
            $table->tinyInteger('minor_units')->default(2);
            $table->boolean('iso4217')->default(true);
            $table->boolean('digital')->default(false);
            
            $table->boolean('custom')->default(false);
            $table->foreignId('user_id')->nullable()->references('id')
            ->on('users');


            $table->index('code');
            $table->index('custom');
            $table->index('iso4217');
            $table->index('digital');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
