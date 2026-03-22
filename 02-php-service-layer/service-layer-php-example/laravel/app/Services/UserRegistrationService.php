<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\DB;
use Exception;

class UserRegistrationService
{
    public function registerUser(array $data): User
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $role = Role::where('name', 'user')->first();
            $user->roles()->attach($role);

            Mail::to($user->email)->send(new WelcomeEmail($user));

            DB::commit();
            
            return $user;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e; // Exception caught globally
        }
    }
}