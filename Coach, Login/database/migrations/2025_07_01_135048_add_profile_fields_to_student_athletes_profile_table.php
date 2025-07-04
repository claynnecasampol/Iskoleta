<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('student_athletes_profile', function (Blueprint $table) {
        $table->id();
            $table->unsignedBigInteger('student_id'); // FK to `students` table

            $table->string('photo')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('event')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('home_address')->nullable();
            $table->string('provincial_address')->nullable();
            $table->string('vaccination')->nullable();
            $table->string('philhealth')->nullable();

            // Education
            $table->string('elementary')->nullable();
            $table->string('secondary')->nullable();
            $table->string('shs')->nullable();
            $table->string('transferee')->nullable();
            $table->string('track_strand')->nullable();
            $table->decimal('gwa_g10', 5, 2)->nullable();
            $table->decimal('gwa_g11', 5, 2)->nullable();
            $table->decimal('gwa_g12', 5, 2)->nullable();

            // Course preferences
            $table->string('first_choice')->nullable();
            $table->string('second_choice')->nullable();
            $table->string('third_choice')->nullable();

            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
};