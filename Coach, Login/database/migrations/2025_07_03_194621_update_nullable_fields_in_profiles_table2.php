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
        // STEP 1: Clean existing NULL values
        DB::table('student_athlete_profiles')->whereNull('middle_name')->update(['middle_name' => '']);
        DB::table('student_athlete_profiles')->whereNull('philhealth')->update(['philhealth' => '']);
        DB::table('student_athlete_profiles')->whereNull('transferee')->update(['transferee' => '']);

        // STEP 2: Alter the columns to NOT NULL with default ''
        Schema::table('student_athlete_profiles', function (Blueprint $table) {
            $table->string('middle_name')->default('')->nullable(false)->change();
            $table->string('philhealth')->default('')->nullable(false)->change();
            $table->string('transferee')->default('')->nullable(false)->change();
        });
    }
};
