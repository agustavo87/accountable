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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('operation_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->foreignId('account_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->smallInteger('type');
            $table->float('amount');
            $table->decimal('amountb',36,0)->default(0);
            $table->bigInteger('currency_number')->default(32);
            $table->tinyInteger('currency_type')->default(CurrencyType::Fiat->value);

            $table->string('note')->nullable();

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
        Schema::dropIfExists('movements');
    }
};
