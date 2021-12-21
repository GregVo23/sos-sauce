<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->string('slug')->nullable();
            $table->string('picture');
            $table->enum('difficulty',['1','2','3','4','5']);
            $table->integer('time');
            $table->integer('review');
            $table->enum('taste',['sucré','salé','amer',]);
            $table->enum('temperature',['chaud','froid','tiède',]);
            $table->foreignId('recipe_meal_id')->nullable();
            $table->foreignId('preperation_id')->nullable();
            $table->foreignId('user_id');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('preperation_id')
            ->references('id')->on('preperations')
            ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('recipe_meal_id')
            ->references('id')->on('recipe_meals')
            ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
