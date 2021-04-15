<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_key');
            $table->string('book_name');
            $table->string('book_id');
            $table->string('book_author');
            $table->string('book_shelf');
            $table->string('book_chapters');
            $table->integer('book_traffic');
            $table->integer('book_status')->comment('0: Pending, 1: Active, 2: Revoked');
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
        Schema::dropIfExists('books');
    }
}
