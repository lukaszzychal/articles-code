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
    /**
     * Main service method handling the registration process.
     */
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

            DB::commit();
            
        } catch (Exception $e) {
            DB::rollBack();
            // The service throws the exception higher up; it doesn't format the HTTP error!
            throw $e; 
        }

        // 4. Business logic - sending an email (CORRECT: Outside transaction)
        Mail::to($user->email)->send(new WelcomeEmail($user));

        return $user;
    }
}
