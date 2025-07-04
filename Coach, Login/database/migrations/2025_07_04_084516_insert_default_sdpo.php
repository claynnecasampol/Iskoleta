<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('sdpo')->insert([
            'fullname' => 'SDPO Admin',
            'email' => 'sdpo@pup.edu.ph',
            'password' => Hash::make('adminpass'), // 🔐 Always hash passwords!
            'org_id' => 'sdpo123',
            'position' => 'SDPO Head',
            'contact' => '09171234567',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('sdpo')->where('email', 'sdpo@pup.edu.ph')->delete();
    }
};
