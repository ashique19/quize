<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizeQuestions', function (Blueprint $table) {
            $table->id();
            $table->string('field1'); // Question Title
            $table->unsignedBigInteger('quize_id');
            $table->foreign('quize_id')->references('id')->on('quizes')->onDelete('cascade');   // If quize is deleted, delete all questions of it automatically.
            $table->boolean('field3'); // is mandatory ?
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
        Schema::dropIfExists('quizeQuestions');
    }
}
