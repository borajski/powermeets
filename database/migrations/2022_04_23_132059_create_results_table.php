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
            $table->float('squat1')->nullable();
            $table->float('squat2')->nullable();
            $table->float('squat3')->nullable();
            $table->float('squat4')->nullable();
            $table->float('bench1')->nullable();
            $table->float('bench2')->nullable();
            $table->float('bench3')->nullable();
            $table->float('bench4')->nullable();
            $table->float('deadlift1')->nullable();
            $table->float('deadlift2')->nullable();
            $table->float('deadlift3')->nullable();
            $table->float('deadlift4')->nullable();
            $table->float('total')->nullable();
            $table->float('points')->nullable();
            $table->float('age_points')->nullable();
            $table->float('timbod')->nullable();         
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
