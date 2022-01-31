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
            $table->string('aktivan')->nullable();
            $table->string('prijavnica')->nullable();
            $table->string('nominacije')->nullable();
            $table->string('natjecanje')->nullable();
            $table->string('rezultati')->nullable();
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
