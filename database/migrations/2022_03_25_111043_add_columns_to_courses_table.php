<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('content')->after('title');
            $table->dropColumn('education');
            $table->foreignIdFor(\App\Models\EducationLevel::class)->after('title')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Specialization::class)->after('title')->nullable()->constrained()->nullOnDelete();
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
            $table->string('education')->nullable();
            $table->dropColumn('content');
            $table->dropForeign('courses_education_level_id_foreign');
            $table->dropColumn('education_level_id');
            $table->dropForeign('courses_specialization_id_foreign');
            $table->dropColumn('specialization_id');
        });
    }
}
