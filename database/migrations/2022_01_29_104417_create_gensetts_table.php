<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGensettsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gensetts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('meet_id')->index();
            $table->string('aktivan')->default('ne');
            $table->string('prijavnica')->default('ne');
            $table->string('nominacije')->default('ne');
            $table->string('natjecanje')->default('ne');
            $table->string('rezultati')->default('ne');
            $table->mediumText('objave')->nullable();
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
        Schema::dropIfExists('gensetts');
    }
}
