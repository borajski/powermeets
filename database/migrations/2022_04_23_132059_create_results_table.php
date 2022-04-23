<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('athlete_id')->index();
            $table->integer('squat1')->nullable();
            $table->integer('squat2')->nullable();
            $table->integer('squat3')->nullable();
            $table->integer('squat4')->nullable();
            $table->integer('bench1')->nullable();
            $table->integer('bench2')->nullable();
            $table->integer('bench3')->nullable();
            $table->integer('bench4')->nullable();
            $table->integer('deadlift1')->nullable();
            $table->integer('deadlift2')->nullable();
            $table->integer('deadlift3')->nullable();
            $table->integer('deadlift4')->nullable();
            $table->integer('total')->nullable();
            $table->integer('points')->nullable();
            $table->integer('age_points')->nullable();
            $table->integer('timbod')->nullable();         
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
        Schema::dropIfExists('results');
    }
}
