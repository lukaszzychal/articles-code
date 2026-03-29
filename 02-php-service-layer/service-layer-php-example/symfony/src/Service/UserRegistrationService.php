<?php

namespace App\Service;

use App\DTO\UserRegistrationDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private MailerInterface $mailer
    ) {}

    public function registerUser(UserRegistrationDTO $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setName($dto->name);
        
        // Assigning a default role
        $user->setRoles(['ROLE_USER']);

        // Hashing the password
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $dto->password
        );
        $user->setPassword($hashedPassword);

        // Saving to the database
        // In Doctrine, flush() implicitly handles the transaction and commit
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Sending an email OUTSIDE/AFTER the database transaction
        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject('Welcome to our app!')
            ->text('Hello ' . $user->getName() . '! Your account has been successfully created.');

        $this->mailer->send($email);

        return $user;
    }
}
