<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id');
            $table->foreignId('ingredient_id');
            $table->integer('quantity');
            $table->integer('step')->default(0);
            $table->string('description')->nullable();
            $table->integer('time')->nullable();
            $table->string('picture')->default("http://localhost:8000/images/logo/sos-sauce.png");

            $table->foreign('ingredient_id')
                ->references('id')->on('ingredients')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('meal_id')
                ->references('id')->on('meals')
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
        Schema::dropIfExists('recipes');
    }
}
