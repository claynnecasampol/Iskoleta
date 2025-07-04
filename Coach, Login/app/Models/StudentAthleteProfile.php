<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAthleteProfile extends Model
{
    use HasFactory;
    protected $table = 'student_athlete_profiles'; // 👈 VERY IMPORTANT

    protected $fillable = [
        'student_id',
        'photo',
        'last_name',
        'first_name',
        'middle_name',
        'event',
        'birth_date',
        'age',
        'height',
        'weight',
        'email',
        'contact',
        'home_address',
        'provincial_address',
        'vaccination',
        'philhealth',
        'elementary',
        'secondary',
        'shs',
        'track_strand',
        'g10',
        'g11',
        'g12',
        'first_choice',
        'second_choice',
        'third_choice',
        'transferee',
        'is_transferee',
        'status',
    ];
        public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function tournamentParticipations()
    {
        return $this->hasMany(TournamentParticipation::class, 'profile_id', 'id');
    }

    public function tournaments()
    {
        return $this->hasMany(\App\Models\TournamentParticipation::class, 'profile_id');
    }
}