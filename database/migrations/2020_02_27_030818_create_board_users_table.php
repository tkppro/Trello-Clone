<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('board_id')->references('id')->on('boards')
                  ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('board_users');
    }
}
