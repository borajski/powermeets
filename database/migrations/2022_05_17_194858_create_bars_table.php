<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('meet_id')->index();
            $table->string('sqbar')->default("20");
            $table->string('sqcoll')->default("2.5");
            $table->string('bpbar')->default("20");
            $table->string('bpcoll')->default("2.5");
            $table->string('dlbar')->default("20");
            $table->string('dlcoll')->default("2.5");
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
        Schema::dropIfExists('bars');
    }
}
