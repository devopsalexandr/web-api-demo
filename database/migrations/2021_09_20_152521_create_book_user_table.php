<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("user_id")->unsigned();;
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->bigInteger("book_id")->unsigned();;
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('cascade');

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
        Schema::dropIfExists('books_users');
    }
}
