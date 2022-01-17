<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaucesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sauces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('picture');
            $table->enum('difficulty', ['1', '2', '3', '4', '5']);
            $table->integer('time');
            $table->integer('review');
            $table->enum('taste', ['sucré', 'salé', 'amer',]);
            $table->enum('temperature', ['chaud', 'froid', 'tiède',]);
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
        Schema::dropIfExists('sauces');
    }
}
