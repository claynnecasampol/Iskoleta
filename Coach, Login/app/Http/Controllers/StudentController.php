<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Grade;
use App\Models\Coach;
use App\Models\StudentAthleteProfile;
use App\Models\TournamentParticipation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    // ── PAGE VIEWS ────────────────────────────────────────────────────────────────

    public function showRegisterForm()
    {
        return view('register');
    }

    public function showStudentLoginForm()
    {
        return view('stlogin');
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }


    public function showSdpoLoginForm()
    {
        return view('sdpologin');
    }

    public function showForgotPasswordForm()
    {
        return view('forgotpassword');
    }

    public function showVerificationCodeForm()
    {
        return view('verificationcode');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function showGrades()
    {
        $student = Student::find(session('student_id'));

        if (!$student) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        return view('Student-Athlete.Grades', compact('student'));
    }

    public function personalProfile()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $athlete = Student::find($studentId);

        $coaches = Coach::all()->groupBy('sport');

        return view('Student-Athlete.SPersonalProfile', [
            'athlete' => $athlete,
            'coaches' => $coaches,
        ]);
    }

    public function showPersonalProfile()
    {
        $student = Student::find(session('student_id'));

        if (!$student) {
            return redirect('/stlogin')->with('error', 'Please log in first.');
        }

        $coaches = Coach::all();

        return view('Student-Athlete.SPersonalProfile', compact('student', 'coaches'));
    }

    public function showHome()
    {
        $athlete = Auth::user();
        return view('Student-Athlete.SAHome', compact('athlete'));
    }

    public function showProfile()
    {
        $student = Auth::user() ?? Student::find(session('student_id'));

        if (!$student) {
            return redirect('/stlogin')->with('error', 'Please log in first.');
        }

        $profile = StudentAthleteProfile::with('tournaments')->where('student_id', $student->id)->first();
        $coaches = Coach::all();

        return view('Student-Athlete.SPersonalProfile', compact('student', 'profile', 'coaches'));
    }

    public function editProfile()
    {
        $athlete = Student::find(session('student_id'));

        if (!$athlete) {
            return redirect('/stlogin')->with('error', 'Please log in first.');
    }

    return view('Student-Athlete.SPUpdateProfile', compact('athlete'));
    }

    public function updateProfile(Request $request)
    {
        $athlete = Student::find(session('student_id'));

        if (!$athlete) {
            return redirect('/stlogin')->with('error', 'Please log in first.');
        }

        $request->validate([
            'firstname'       => 'required|string|max:255',
            'lastname'        => 'required|string|max:255',
            'contact'         => 'required|string|max:15',
            'course'          => 'required|string|max:255',
            'year_level'      => 'required|string',
            'current_password'=> 'nullable|string',
            'new_password'    => 'nullable|string|min:8',
        ]);

        $athlete->first_name = $request->firstname;
        $athlete->last_name  = $request->lastname;
        $athlete->contact    = $request->contact;
        $athlete->course     = $request->course;
        $athlete->year_level = $request->year_level;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $athlete->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $athlete->password = Hash::make($request->new_password);
        }

        $athlete->save();

        return redirect()->route('personal.profile')->with('success', 'Profile updated successfully!');
    }

    public function showProfileForm()
    {
        $student = Student::find(session('student_id'));

        if (!$student) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $profile = StudentAthleteProfile::where('student_id', $student->id)->first();
        $status = $profile->status ?? null;
        $isSubmitted = in_array($status, ['pending', 'approved']);

        $tournaments = TournamentParticipation::where('student_id', $student->id)->get();

        return view('Student-Athlete.SAProfile', compact('student', 'profile', 'status', 'isSubmitted', 'tournaments'));
    }

    protected static function booted()
    {
        static::deleting(function ($profile) {
            $profile->tournamentParticipations()->delete();
        });
    }

    public function submitProfileForm(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'nullable|image|max:2048',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'event' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'home_address' => 'required|string',
            'provincial_address' => 'required|string',
            'vaccination' => 'required|string',
            'philhealth' => 'nullable|string|max:255',
            'elementary' => 'required|string',
            'secondary' => 'required|string',
            'shs' => 'required|string',
            'track_strand' => 'required|string',
            'g10' => 'required|numeric',
            'g11' => 'required|numeric',
            'g12' => 'required|numeric',
            'first_choice' => 'required|string',
            'second_choice' => 'required|string',
            'third_choice' => 'required|string',
            'transferee' => 'nullable|string',
            'isTransferee' => 'nullable|boolean',
        ]);

        $student = Student::find(session('student_id'));

        if (!$student) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $photoPath = $profile->photo ?? null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $profile = StudentAthleteProfile::updateOrCreate(
            ['student_id' => $student->id],
            [
                'photo' => $photoPath,
                'last_name' => $validated['lastname'],
                'first_name' => $validated['firstname'],
                'middle_name' => $validated['middlename'] ?? '',
                'event' => $validated['event'],
                'birth_date' => $validated['birth_date'],
                'age' => $validated['age'],
                'height' => $validated['height'],
                'weight' => $validated['weight'],
                'email' => $validated['email'],
                'contact' => $validated['contact'],
                'home_address' => $validated['home_address'],
                'provincial_address' => $validated['provincial_address'],
                'vaccination' => $validated['vaccination'],
                'philhealth' => $validated['philhealth'] ?? '',
                'elementary' => $validated['elementary'],
                'secondary' => $validated['secondary'],
                'shs' => $validated['shs'],
                'is_transferee' => $request->has('isTransferee'),
                'transferee' => $validated['transferee'] ?? '',
                'track_strand' => $validated['track_strand'],
                'g10' => $validated['g10'],
                'g11' => $validated['g11'],
                'g12' => $validated['g12'],
                'first_choice' => $validated['first_choice'],
                'second_choice' => $validated['second_choice'],
                'third_choice' => $validated['third_choice'],
                'status' => 'pending', // Lock profile after submit
            ]
        );

        TournamentParticipation::where('profile_id', $profile->id)->delete();

            $names = $request->input('ntournament', []);
            $levels = $request->input('level', []);
            $years = $request->input('year', []);
            $awards = $request->input('awards', []);

            foreach ($names as $i => $tournament) {
                if (!empty($tournament)) {
                    TournamentParticipation::create([
                        'profile_id' => $profile->id,
                        'tournament_name' => $tournament,
                        'level' => $levels[$i] ?? null,
                        'year' => $years[$i] ?? null,
                        'awards' => $awards[$i] ?? null,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Athletic profile submitted successfully.');
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname'  => 'required|string|max:255',
            'lastname'   => 'required|string|max:255',
            'age'        => 'required|integer',
            'course'     => 'required|string',
            'year'       => 'required|string',
            'schoolmail' => 'required|email|unique:students,school_email',
            'psw'        => 'required|string|min:6|confirmed',
        ]);

        Student::create([
            'first_name'   => $validated['firstname'],
            'last_name'    => $validated['lastname'],
            'age'          => $validated['age'],
            'course'       => $validated['course'],
            'year_level'   => $validated['year'],
            'school_email' => $validated['schoolmail'],
            'password'     => Hash::make($validated['psw']),
        ]);

        return redirect()->back()->with('success', 'Student registered successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'schoolmail' => 'required|email',
            'psw' => 'required',
        ]);

        $student = Student::where('school_email', $request->schoolmail)->first();

        if (!$student || !Hash::check($request->psw, $student->password)) {
            return back()->with('error', 'Invalid credentials.');
        }

        Session::put('student_id', $student->id);

        $athlete = [
            'firstname'   => $student->first_name,
            'lastname'    => $student->last_name,
            'schoolmail'  => $student->school_email,
            'age'         => $student->age,
            'course'      => $student->course,
            'year_level'  => $student->year_level,
        ];

        return view('Student-Athlete.SAHome', compact('athlete'));
    }


    public function submitGrades(Request $request)
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        // ✅ Step 1: Validate input
        $request->validate([
            'subject.*' => 'required|string',
            'grade.*' => 'required|string',
            'proof_overall' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ✅ Step 2: Upload file
        $path = $request->file('proof_overall')->store('grade_proofs', 'public');

        // ✅ Step 3: Save each grade entry to DB
        foreach ($request->subject as $index => $subject) {
            Grade::create([
                'student_id' => $studentId,
                'subject' => $subject,
                'grade' => $request->grade[$index],
                'proof_file' => $path, // ✅ Now this will work because $path is defined above
            ]);
        }

        return back()->with('success', 'Grades submitted successfully.');
    }

    public function viewProfile()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $athlete = Student::find($studentId); // or StudentAthlete model if used

        return view('Student-Athlete.SPersonalProfile', compact('athlete'));
    }

    public function submitVerification(Request $request)
    {
        $studentId = session('student_id');
        if (!$studentId) {
            return response('Unauthorized', 401);
        }

        $request->validate([
            'sport' => 'required|string|max:255',
            'coach' => 'required|exists:coaches,id',
        ]);

        $profile = StudentAthleteProfile::where('student_id', $studentId)->first();

        if (!$profile) {
            return response('No profile found', 404);
        }

        $profile->event = $request->sport;
        $profile->coach_id = $request->coach;
        $profile->status = 'pending'; // Set to pending for coach review
        $profile->save();

        return response('Submitted', 200);
    }


}