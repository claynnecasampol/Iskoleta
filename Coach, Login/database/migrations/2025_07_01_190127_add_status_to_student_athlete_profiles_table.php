<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('student_athlete_profiles', function (Blueprint $table) {
            $table->string('status')->default('pending'); // 'pending', 'approved', 'rejected'
        });
    }

    public function down()
    {
        Schema::table('student_athlete_profiles', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
