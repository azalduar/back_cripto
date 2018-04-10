<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->unique();
            $table->string('image');
            $table->unsignedInteger('rating_id');
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');
            
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
}
