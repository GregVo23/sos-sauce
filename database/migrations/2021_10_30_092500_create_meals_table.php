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
            $table->string('picture')->default("http://localhost:8000/images/logo/sos-sauce.png");
            $table->enum('difficulty', ['1', '2', '3', '4', '5'])->nullable();
            $table->integer('time')->nullable();
            $table->integer('number')->nullable();
            $table->integer('review')->nullable();
            $table->enum('taste', ['sucré', 'salé', 'amer',])->default('salé');
            $table->enum('temperature', ['chaud', 'froid', 'tiède',])->default('chaud');
            $table->foreignId('user_id');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
