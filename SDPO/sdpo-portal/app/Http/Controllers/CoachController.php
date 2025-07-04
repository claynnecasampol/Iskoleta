<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{
    public function index()
    {
        return response()->json(Coach::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:coaches,email',
            'sport' => 'required|string',
            'org_id' => 'required|string|unique:coaches,org_id',
            'password' => 'required|string|min:6',
        ]);

        $coach = Coach::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
            'contact' => $request->contact,
            'address' => $request->address,
        ]);

        return response()->json($coach, 201);
    }
}

