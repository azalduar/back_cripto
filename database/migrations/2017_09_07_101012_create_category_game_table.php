<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryGameTable extends Migration
{
    public function up()
    {
        Schema::create('category_game', function (Blueprint $table) {

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('game_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->primary(['category_id', 'game_id']);
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_game');
    }
}
