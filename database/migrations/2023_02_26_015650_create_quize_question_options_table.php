<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizeQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizeQuestionOptions', function (Blueprint $table) {
            $table->id();
            $table->string('field1');   // title
            $table->boolean('field2');  // is right answer ?
            $table->unsignedBigInteger('quizeQuestion_id');
            $table->foreign('quizeQuestion_id')->references('id')->on('quizeQuestions')->onDelete('cascade');   // if question deleted, delete its options automatically.
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
        Schema::dropIfExists('quizeQuestionOptions');
    }
}
