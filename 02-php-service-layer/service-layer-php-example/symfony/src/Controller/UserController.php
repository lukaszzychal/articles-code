<?php

namespace App\Controller;

use App\DTO\UserRegistrationDTO;
use App\Service\UserRegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/users', methods: ['POST'])]
    public function store(
        #[MapRequestPayload] UserRegistrationDTO $userDto, 
        UserRegistrationService $service
    ): JsonResponse {
        
        // Validated DTO goes directly to the service
        $user = $service->registerUser($userDto);

        // Exceptions handled by Event Subscribers
        return $this->json(['message' => 'User created', 'id' => $user->getId()], 201);
    }
}