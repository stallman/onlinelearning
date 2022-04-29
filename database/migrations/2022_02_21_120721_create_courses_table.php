<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->foreignIdFor(\App\Models\CourseCategory::class)
                ->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_home_visible')->default(false);
            $table->boolean('is_visible')->default(false);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->text('announcement');
            $table->text('description');
            $table->foreignIdFor(\App\Models\User::class)
                ->nullable()->constrained()->nullOnDelete();

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
        Schema::dropIfExists('courses');
    }
}
