<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefineBestAnswerIdAsForeignKeyInQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('best_answer_id')->index()->nullable()->change();

            $table->foreign('best_answer_id')
              ->references('id')
              ->on('answers')
              ->onUpdate('cascade')
              ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropIndex(['best_answer_id']);
        });
    }
}
