<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable()->after('id');
            $table->string('patronymic')->nullable()->after('name');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('job')->nullable()->after('phone');
            $table->string('position')->nullable()->after('job');
            $table->foreignIdFor(\App\Models\Specialization::class)->nullable()->after('position')->constrained()->nullOnDelete();
            $table->string('image', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('patronymic');
            $table->dropColumn('phone');
            $table->dropColumn('job');
            $table->dropColumn('image');
            $table->dropColumn('position');
            $table->dropForeign(['specialization_id']);
            $table->dropColumn('specialization_id');

        });
    }
}
