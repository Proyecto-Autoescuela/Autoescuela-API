<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('questions');
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo_url');
            $table->string('question')->unique();
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c');
            $table->enum('correct_answer',['answer_a', 'answer_b', 'answer_c']);
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
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
        Schema::dropIfExists('questions');
    }
}