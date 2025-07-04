<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_athlete_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('coach_id')->nullable()->after('student_id');
            $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('student_athlete_profiles', function (Blueprint $table) {
            $table->dropForeign(['coach_id']);
            $table->dropColumn('coach_id');
        });
    }
};
