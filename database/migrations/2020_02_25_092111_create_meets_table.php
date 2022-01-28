<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index();
            $table->text('naziv')->nullable();
            $table->text('organizator')->nullable();
            $table->text('email')->nullable();
            $table->text('federacija')->nullable();
            $table->text('logo')->nullable();
            $table->text('slika')->nullable();
            $table->text('mjesto')->nullable();
            $table->date('datump')->nullable();
            $table->date('datumk')->nullable();
            $table->text('discipline')->nullable();
            $table->mediumText('opis')->nullable();
            $table->text('pocetna')->nullable();
            $table->text('prijave')->nullable();
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
        Schema::dropIfExists('meets');
    }
}
