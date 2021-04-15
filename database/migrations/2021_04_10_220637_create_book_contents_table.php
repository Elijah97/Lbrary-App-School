<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_key');
            $table->string('book_key');
            $table->integer('book_chapter');
            $table->string('content')->comment('Description');;
            $table->integer('status')->comment('0: Pending, 1: Active, 2: Revoked');
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
        Schema::dropIfExists('book_contents');
    }
}
