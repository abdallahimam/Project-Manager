<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('address')->nullable();
                $table->longText('description')->nullable();
                $table->integer('user_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('first_name');
                $table->string('middle_name');
                $table->string('last_name');
                $table->string('city')->nullable();
                $table->string('api_token')->nullable();
                $table->string('address')->nullable();
                $table->string('country')->nullable();
                $table->integer('postal_code')->unsigned()->nullable();
                $table->string('phone')->nullable();
                $table->longText('about_me')->nullable();
                $table->integer('role_id')->unsigned();
                $table->integer('work_at')->unsigned()->nullable();
                $table->rememberToken();
                $table->softDeletes();
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('work_at')->references('id')->on('companies')->onDelete('cascade');
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
