<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\StudentAthleteProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SDPOController extends Controller
{
    public function showSDPOLoginForm()
    {
        return view('sdpo.sdpologin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('orgid', 'psw');

        // 🔒 Example: hardcoded credentials (for now)
        if ($credentials['orgid'] === 'sdpo123' && $credentials['psw'] === 'adminpass') {
            Session::put('sdpo_logged_in', true);
            return redirect('/sdpo/home');
        }

        return back()->with('error', 'Invalid organizational ID or password');
    }

    public function storeCoach(Request $request)
    {
        $request->validate([
            'coach_name' => 'required|string|max:255',
            'coach_email' => 'required|email|unique:coaches,email',
            'sport' => 'required|string',
            'org_id' => 'required|string|unique:coaches,org_id',
            'temp_password' => 'required|string|min:6',
        ]);

        $coach = new Coach();
        $coach->name = $request->coach_name;
        $coach->email = $request->coach_email;
        $coach->sport = $request->sport;
        $coach->org_id = $request->org_id;
        $coach->password = Hash::make($request->temp_password); // Secure password storage
        $coach->save();

        return redirect()->route('sdpo.coaches')->with('success', 'Coach created successfully!');
    }

    public function registeredCoaches()
    {
        $coaches = Coach::all();
        return view('sdpo.registered_coaches', compact('coaches'));
    }

    public function showDashboard()
    {
        return view('sdpo.sdpohome');
    }

    public function viewRegisteredAthletes()
    {
        $athletes = StudentAthleteProfile::all(); // Or with Coach if needed
        return view('sdpo.RegStudAthlete', compact('athletes'));
    }

    public function editProfile()
    {
        $sdpo = Auth::user(); // Assuming SDPO is authenticated
        return view('sdpo.setup-profile', compact('sdpo'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $sdpo = Auth::user();
        $sdpo->fullname = $request->fullname;
        $sdpo->position = $request->designation;
        $sdpo->email = $request->email;
        $sdpo->contact = $request->contact;

        if ($request->filled('password')) {
            $sdpo->password = bcrypt($request->password);
        }

        $sdpo->save();

        return redirect()->route('sdpo.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function viewCoach($id)
    {
        $coach = Coach::findOrFail($id);
        return view('sdpo.view-coach', compact('coach'));
    }

    public function viewAthlete($id)
    {
        $athlete = StudentAthleteProfile::with('tournaments')->findOrFail($id);
        return view('sdpo.view-student-athlete', compact('athlete'));
    }

    public function saveCoach(Request $request)
    {
        $request->validate([
            'coach_name' => 'required|string|max:255',
            'coach_email' => 'required|email|unique:coaches,email',
            'sport' => 'required|string',
            'org_id' => 'required|string|unique:coaches,org_id',
            'temp_password' => 'required|string|min:6',
        ]);

        Coach::create([
            'name' => $request->coach_name,
            'email' => $request->coach_email,
            'sport' => $request->sport,
            'org_id' => $request->org_id,
            'password' => Hash::make($request->temp_password), // hash the temp password
        ]);

        return redirect('/sdpo/coaches')->with('success', 'Coach account created successfully.');
    }

    public function viewRegisteredCoach()
    {
        $coaches = Coach::all(); // Fetch all registered coaches
        return view('sdpo.RegisteredCoach', compact('coaches'));
    }

    public function showCreateCoachForm()
    {
        return view('sdpo.CreateCoach'); // Match the filename
    }
}
