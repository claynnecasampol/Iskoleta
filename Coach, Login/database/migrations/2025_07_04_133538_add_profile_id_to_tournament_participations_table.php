<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tournament_participations', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id')->nullable();

            $table->foreign('profile_id')
                ->references('id')
                ->on('student_athlete_profiles')
                ->onDelete('cascade');
        });
    }
};
