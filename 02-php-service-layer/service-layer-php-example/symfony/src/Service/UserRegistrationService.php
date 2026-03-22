<?php

namespace App\Service;

use App\DTO\UserRegistrationDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\Mailer\MailerInterface; ...itd.

class UserRegistrationService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function registerUser(UserRegistrationDTO $dto): User
    {
        // Here is the logic for creating the User object for Doctrine, 
        // hashing the password and saving it to the database.
        
        $user = new User();
        $user->setEmail($dto->email);
        $user->setName($dto->name);
        // ...
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}