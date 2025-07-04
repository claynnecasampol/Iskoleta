<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentParticipation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'tournament_name',
        'level',
        'year',
        'awards',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function profile()
    {
        return $this->belongsTo(StudentAthleteProfile::class, 'profile_id');
    }
}