<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationDTO
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    public string $password;
}