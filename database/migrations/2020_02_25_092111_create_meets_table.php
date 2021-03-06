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
            $table->string('naziv')->nullable();
            $table->string('organizator')->nullable();
            $table->string('federation_id')->index();
            $table->string('slika')->nullable();
            $table->string('mjesto')->nullable();
            $table->date('datump')->nullable();
            $table->date('datumk')->nullable();
            $table->string('discipline')->nullable();
            $table->mediumText('opis')->nullable();
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
