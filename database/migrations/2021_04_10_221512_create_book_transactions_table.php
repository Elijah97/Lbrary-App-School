<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_key');
            $table->string('user_key');
            $table->integer('status')->comment('0: Borrowed, 1: Returned');
            $table->integer('book_condition')->comment('1 - 5 Book condition')->nullable();
            $table->date('date_borrowed');
            $table->date('date_returned')->nullable();
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
        Schema::dropIfExists('book_transactions');
    }
}
