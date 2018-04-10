<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUserTable extends Migration
{
    public function up()
    {
        Schema::create('game_user', function (Blueprint $table) {

            $table->unsignedInteger('game_id');
            $table->unsignedInteger('user_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['game_id', 'user_id']);
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_user');
    }
}
