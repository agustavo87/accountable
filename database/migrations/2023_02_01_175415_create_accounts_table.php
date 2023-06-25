<?php

use App\Values\CurrencyType;
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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->string('name');
            $table->string('currency');
            $table->float('balance');
            $table->decimal('balance_amount',36,0)->default(0);
            $table->bigInteger('balance_currency_number')->default(32);
            $table->tinyInteger('balance_currency_type')->default(CurrencyType::Fiat->value);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
