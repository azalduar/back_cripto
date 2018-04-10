<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformsTable extends Migration
{
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->unique();
            $table->string('logo');
            
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
