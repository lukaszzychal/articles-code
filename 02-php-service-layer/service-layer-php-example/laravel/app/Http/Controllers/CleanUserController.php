<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\UserRegistrationService;
use Illuminate\Http\JsonResponse;

class CleanUserController extends Controller
{
    public function store(RegisterUserRequest $request, UserRegistrationService $service): JsonResponse
    {
        // The controller passes clean data to the service
        $user = $service->registerUser($request->validated());
        
        // No try-catch, errors are handled by the global Exception Handler
        return response()->json(['message' => 'User created', 'user' => $user], 201);
    }
}