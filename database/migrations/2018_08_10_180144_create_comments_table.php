<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                
                $table->increments('id')->unsigned();
                $table->string('url', 255)->nullable();
                $table->longText('body');
                $table->integer('commentable_id')->unsigned();
                $table->string('commentable_type');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
