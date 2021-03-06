<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
    
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->date('release_date');
            $table->string('country');
            $table->float('price');
            $table->string('photo');
            $table->timestamps();
    
        });
    
        Schema::create('film_genre', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('film_slug');
            $table->unsignedInteger('genre_id');
    
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('film_slug')->references('slug')->on('films')->onDelete('cascade');
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
        Schema::dropIfExists('films');
    }
}
