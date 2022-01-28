<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedInteger('user_id');
        $table->string('fname');
        $table->string('lname')->nullable();
        $table->string('country')->nullable();
        $table->string('avatar')->default('images/users/default-avatar.png');
        $table->string('public')->nullable();
        $table->string('role')->default('manager');
        $table->string('live')->default('da');
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
        Schema::dropIfExists('user_details');
    }
}
