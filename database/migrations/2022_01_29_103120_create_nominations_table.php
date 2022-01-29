<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('meet_id')->index();
            $table->string('ime')->nullable();
            $table->string('prezime')->nullable();
            $table->string('drzava')->nullable();
            $table->string('klub')->nullable();
            $table->string('email')->nullable();
            $table->string('datum')->nullable();
            $table->string('kategorijat')->nullable();
            $table->string('kategorijag')->nullable();
            $table->string('spol')->nullable();
            $table->string('disciplina')->nullable();
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
        Schema::dropIfExists('nominations');
    }
}
