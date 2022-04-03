<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomination_id')->index();
            $table->unsignedInteger('meet_id')->index();
            $table->string('spol')->nullable();
            $table->string('weight')->nullable();
            $table->string('age')->nullable();
            $table->string('kategorijat')->nullable();
            $table->string('kategorijag')->nullable();
            $table->string('weight_coef')->nullable();
            $table->string('age_coef')->nullable();
            $table->string('discipline')->nullable();
            $table->string('flight')->nullable();
            $table->string('sq_rack')->nullable();
            $table->string('bp_rack')->nullable();
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
        Schema::dropIfExists('athletes');
    }
}
