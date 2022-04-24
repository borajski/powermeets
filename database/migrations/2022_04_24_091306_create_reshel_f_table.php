<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReshelFTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reshel_f', function (Blueprint $table) {
            $table->id();
            $table->integer('tezina')->nullable();
            $table->string('tocna')->nullable();
            $table->string('plus025')->nullable();
            $table->string('plus050')->nullable();
            $table->string('plus075')->nullable();
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
        Schema::dropIfExists('reshel_f');
    }
}
