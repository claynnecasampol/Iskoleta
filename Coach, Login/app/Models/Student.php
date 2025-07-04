<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'course',
        'year_level',
        'school_email',
        'password',
    ];
    public function profile()
    {
        return $this->hasOne(StudentAthleteProfile::class);
    }

    public function tournaments()
    {
        return $this->hasMany(TournamentParticipation::class);
    }
            
}
