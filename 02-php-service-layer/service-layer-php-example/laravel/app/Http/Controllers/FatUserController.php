<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\DB;

class FatUserController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validation in the controller
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        try {
            DB::beginTransaction();

            // 2. Logic - user creation
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 3. Logic - role assignment
            $role = Role::where('name', 'user')->first();
            $user->roles()->attach($role);

            // 4. Logic - email dispatch
            Mail::to($user->email)->send(new WelcomeEmail($user));

            DB::commit();

            return response()->json(['message' => 'User created', 'user' => $user], 201);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}