<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_athlete_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('photo')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('event');
            $table->date('birth_date')->nullable();
            $table->integer('age');
            $table->integer('height');
            $table->integer('weight');
            $table->string('email');
            $table->string('contact');
            $table->text('home_address');
            $table->text('provincial_address');
            $table->string('vaccination');
            $table->string('philhealth')->nullable();
            $table->string('elementary');
            $table->string('secondary');
            $table->string('shs');
            $table->string('track_strand');
            $table->decimal('g10', 5, 2);
            $table->decimal('g11', 5, 2);
            $table->decimal('g12', 5, 2);
            $table->string('first_choice');
            $table->string('second_choice');
            $table->string('third_choice');
            $table->string('transferee')->nullable();
            $table->boolean('is_transferee')->default(false);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
};
