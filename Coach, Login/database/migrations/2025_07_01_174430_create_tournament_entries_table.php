<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tournament_participations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // FK to students
            $table->string('tournament_name');
            $table->string('level');
            $table->year('year')->nullable();
            $table->string('awards')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_participations');
    }
};
