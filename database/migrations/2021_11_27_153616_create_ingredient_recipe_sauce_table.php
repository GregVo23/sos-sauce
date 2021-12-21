<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientRecipeSauceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe_sauce', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_sauce_id')->unsigned();
            $table->foreignId('ingredient_id')->unsigned();

            $table->foreign('recipe_sauce_id')
                    ->references('id')->on('recipe_sauces')
                    ->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('ingredient_recipe_sauce');
    }
}
