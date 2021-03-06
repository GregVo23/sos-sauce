<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name')->default('my first name');
            $table->string('email')->unique();
            $table->enum('gender', ['man', 'woman', 'other'])->nullable();
            $table->text('about')->nullable();
            $table->timestamp('birthday')->default(today());
            $table->timestamp('member_since')->default(today());
            $table->timestamp('email_verified_at')->nullable();
            $table->string('api_token')->nullable()->default(null);
            $table->string('user_token')->nullable()->default(null);
            $table->string('password');
            $table->string('avatar')->default("./images/profil.png");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
