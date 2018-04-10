<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamePlatformTable extends Migration
{
    public function up()
    {
        Schema::create('game_platform', function (Blueprint $table) {

            $table->unsignedInteger('game_id');
            $table->unsignedInteger('platform_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            $table->primary(['game_id', 'platform_id']);            
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_platform');
    }
}
