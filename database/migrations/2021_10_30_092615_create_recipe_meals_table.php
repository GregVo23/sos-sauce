<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_meals', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('ingredient_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
            $table->enum('meat',['viandes rouges','viandes blanches','gibier','viande séchée','viande de brousse','poissons','crustacés','mollusques','insectes',])->nullable();
            $table->enum('starchy',['riz','pommes de terre','pain','pâtes','céréales',])->nullable();
            $table->foreignId('ingredient_id');

            $table->foreign('ingredient_id')
            ->references('id')->on('ingredients')
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
        Schema::dropIfExists('recipe_meals');
    }
}
