<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Coach;
use App\Models\StudentAthleteProfile;
use App\Models\TournamentParticipation;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{
    public function showCoachLoginForm()
    {
        return view('coach.clogin'); // or 'coach.login' depending on the filename
    }

    public function login(Request $request)
    {
        $coach = Coach::where('email', $request->email)->first();

        if ($coach && Hash::check($request->password, $coach->password)) {
            session(['coach_id' => $coach->id]);
            return redirect('/coach/home');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    

    public function showDashboard()
    {
        $coach = Coach::find(session('coach_id'));
        return view('coach.CHome', compact('coach'));
    }

    public function pendingApplications()
    {
        $coachId = Auth::guard('coach')->id();

        $pendingProfiles = StudentAthleteProfile::with('student')
            ->where('coach_id', $coachId)
            ->where('status', 'pending')
            ->get();

        return view('Coach.PendingApplications', compact('pendingProfiles'));
    }


    public function showProfile()
    {
       
        $coach = Auth::user(); 

        $sdpo = [
            'contact' => $coach->contact ?? 'Not set'
        ];

        return view('coach.ProfileCoach', compact('coach', 'sdpo'));
    }

    public function viewStudentProfiles()
    {
        $students = StudentAthleteProfile::all(); // You can filter by sport or status
        return view('coach.RegStudAthlete', compact('students'));
    }

    public function showAthleteProfile($id)
    {
        $student = Student::findOrFail($id);

        $profile = StudentAthleteProfile::where('student_id', $id)
            ->with('tournaments') // eager load here
            ->first();

        return view('coach.ViewStudAth', [
            'athlete' => $profile,
            'student' => $student
        ]);
    }

    public function setupProfile()
    {
        $coach = Coach::find(session('coach_id'));
        return view('coach.SetUpProfile', compact('coach'));
    }

    public function registerAthlete()
    {
        $athletes = StudentAthleteProfile::all(); // or use filters
        return view('coach.RegStudAthlete', compact('athletes'));
    }

    public function registeredCoaches()
    {
        $coaches = Coach::all(); // or filter based on org_id if needed
        return view('sdpo.RegisteredCoach', compact('coaches'));
    }

    
}