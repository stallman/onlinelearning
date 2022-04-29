<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCoursesTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('image')->nullable();
            $table->boolean('is_nmo_balls')->default(0);
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('duration')->nullable();
            $table->string('education')->nullable();
            $table->boolean('is_has_certificate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('is_nmo_balls');
            $table->dropColumn('price');
            $table->dropColumn('duration');
            $table->dropColumn('is_has_certificate');
        });
    }
}
