<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\SDPOController;
use Illuminate\Support\Facades\Auth;

// Home
Route::view('/', 'welcome')->name('home');

// Registration
Route::get('/register',    [StudentController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register',   [StudentController::class, 'store'])->name('register.submit');

// Student Login
Route::get('/stlogin',     [StudentController::class, 'showStudentLoginForm'])->name('student.login.form');
Route::post('/stlogin',    [StudentController::class, 'login'])->name('student.login.submit');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home')->with('success', 'Logged out successfully.');
})->name('logout');

// SDPO Login
Route::get('/sdpologin',   [StudentController::class, 'showSdpoLoginForm'])->name('sdpo.login.form');

// Forgot Password
Route::get('/forgotpassword', [StudentController::class, 'showForgotPasswordForm'])->name('password.request');

// Verification Code
Route::get('/verificationcode', [StudentController::class, 'showVerificationCodeForm'])->name('verification.form');
Route::post('/verify', function (Request $request) {
    $code = implode('', $request->input('code'));
    if ($code === '123456') {
        return redirect()->route('home')->with('success', 'Verification successful!');
    }
    return back()->with('error', 'Invalid verification code.');
})->name('verification.submit');

// Student-Athlete Home (Dashboard)
Route::get('/sahome', [StudentController::class, 'showSAHome'])->name('sahome')->middleware('auth.custom');

// Student-Athlete Atheltic Profile
Route::get('/SAProfile', [StudentController::class, 'showProfileForm'])->name('athlete.profile.form');
Route::post('/SAProfile', [StudentController::class, 'submitProfileForm'])->name('athlete.profile.submit');


// Student-Athlete Grades
Route::get('/Grades', [StudentController::class, 'showGrades'])->name('grades');
Route::post('/Grades', [StudentController::class, 'submitGrades'])->name('grades.submit');

// Student-Athlete Personal Profile
// 1) Read‑only profile:
Route::get('/profile', [StudentController::class, 'showProfile'])->name('personal.profile');

// 2) Edit form:
Route::get('/profile/edit', [StudentController::class, 'editProfile'])->name('personal.profile.edit');

// 3) Submit update:
Route::post('/profile', [StudentController::class, 'updateProfile'])->name('personal.profile.update');


Route::get('/coach/login', [CoachController::class, 'showCoachLoginForm'])->name('coach.login.form');
Route::post('/coach/login', [CoachController::class, 'login'])->name('coach.login.submit');
Route::get('/coach/home', [CoachController::class, 'showDashboard']);
Route::get('/coach/profile', [CoachController::class, 'showProfile'])->name('coach.profile');
Route::get('/coach/setup', [CoachController::class, 'setupProfile']);
Route::get('/coach/registered-athletes', [CoachController::class, 'viewStudentProfiles'])->name('coach.registered');
Route::get('/coach/view-athlete/{id}', [CoachController::class, 'showAthleteProfile']);
Route::get('/coach/applications', [CoachController::class, 'showApplications'])->name('coach.applications');
Route::get('/coach/pending-applications', [CoachController::class, 'showPendingApplication'])->name('coach.pending');



//
Route::get('/sdpologin', [SDPOController::class, 'showSDPOLoginForm'])->name('sdpo.login.form');
Route::post('/sdpologin', [SDPOController::class, 'login'])->name('sdpo.login.submit');
Route::get('/sdpo/create-coach', [SDPOController::class, 'showCreateCoachForm']);
Route::post('/sdpo/save-coach', [SDPOController::class, 'storeCoach'])->name('sdpo.save.coach');
Route::get('/sdpo/coaches', [SDPOController::class, 'registeredCoaches'])->name('sdpo.coaches');
Route::get('/sdpo/home', [SDPOController::class, 'showDashboard'])->name('sdpo.dashboard');
Route::get('/sdpo/registered-students', [SDPOController::class, 'viewRegisteredAthletes'])->name('sdpo.registered.students');
Route::get('/sdpo/profile/edit', [SDPOController::class, 'editProfile'])->name('sdpo.profile.edit');
Route::post('/sdpo/profile/save', [SDPOController::class, 'updateProfile'])->name('sdpo.profile.save');
Route::get('/sdpo/view-coach/{id}', [SDPOController::class, 'viewCoach'])->name('sdpo.view.coach');
Route::get('/sdpo/registered-coach', [SDPOController::class, 'viewRegisteredCoach'])->name('sdpo.registered.coach');