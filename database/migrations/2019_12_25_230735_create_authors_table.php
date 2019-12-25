<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->timestamps();
        });
        Schema::create('author_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('author_book', function (Blueprint $table) {
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('author_type_id');

            $table->unique(['book_id', 'author_id', 'author_type_id']);

            $table->foreign('book_id')->on('books')->references('id')->onDelete('cascade');
            $table->foreign('author_id')->on('authors')->references('id')->onDelete('cascade');
            $table->foreign('author_type_id')->on('author_types')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('author_types');
    }
}
