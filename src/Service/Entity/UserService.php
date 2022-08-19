<?php

namespace App\Service\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function add(object $data): bool
    {
        $userCreated = false;
        if ($this->checkData($data)) {

            $userNew = new User();
            $userNew
                ->setUsername($data->username)
                ->setEmail($data->email)
                ->setPassword($this->userPasswordHasher->hashPassword($userNew, $data->password))
                ->setRoles(["ROLE_USER"]);
            $this->userRepository->add($userNew, true);
            $userCreated = true;
        }
        return $userCreated;
    }

    public function checkData(object $data): bool
    {
        $dataIsCorrect = true;
        if (
            !property_exists($data, "username")
            || !strlen($data->username)
            || $this->userRepository->count(["username" => $data->username])
        ) {
            $dataIsCorrect =  false;
        }
        if (
            !property_exists($data, "email")
            || !filter_var($data->email, FILTER_VALIDATE_EMAIL)
            || $this->userRepository->count(["email" => $data->email])
        ) {
            $dataIsCorrect =  false;
        }
        if (
            !property_exists($data, "password")
            || !property_exists($data, "passwordVerified")
            || !preg_match("/[a-zA-Z0-9]{6,20}/", $data->username)
            || $data->password !== $data->passwordVerified
        ) {
            $dataIsCorrect =  false;
        }
        return $dataIsCorrect;
    }
}
