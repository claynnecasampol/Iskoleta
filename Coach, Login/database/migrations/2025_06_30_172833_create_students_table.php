<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('course');
            $table->string('year_level');
            $table->string('school_email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

};
