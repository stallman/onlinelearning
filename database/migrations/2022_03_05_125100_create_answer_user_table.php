<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_user', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Question::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Answer::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->text('text')->nullable();
            //для ответов типа right_order, где нужно выбирать верный порядок,
            //узнавать порядок который выбрал пользователь будем по дате создания
            //либо по порядку расположения в бд
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
        Schema::dropIfExists('answer_user');
    }
}
