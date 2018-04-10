<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTagTable extends Migration
{
    public function up()
    {
        Schema::create('game_tag', function (Blueprint $table) {

            $table->unsignedInteger('game_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->primary(['game_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_tag');
    }
}
