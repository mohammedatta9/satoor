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
            $table->string('symbol', 10)->nullable();     // رمز العملة (مثل $, €, ¥)
            $table->string('iso_code', 3)->nullable();    // الرمز الثلاثي (مثل USD, EUR, JPY)
            $table->string('name', 100)->nullable();      // اسم العملة (مثل Dollar, Euro, Yen)
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
        Schema::dropIfExists('currencies');
    }
};
