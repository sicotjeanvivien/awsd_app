<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Component\Security\Core\Security;

class SecurityService
{
    public function __construct(
        private Security $security,
        private UserRepository $userRepository
    ) {
    }

    public function checkUserConnected(): bool
    {
        $user_is_connected = false;
        if ($this->security->getUser()) $user_is_connected = true;
        return $user_is_connected;
    }

    public function genaratedAuthToken(User $user): string
    {
        $token = bin2hex(random_bytes(64));
        $user
            ->setAuthToken($token)
            ->setAuthTokenGenerationDate(new DateTime("now"));
        $this->userRepository->add($user, true);
        return $token;
    }
}
