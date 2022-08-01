<?php
namespace App\Service;

use Symfony\Component\Security\Core\Security;

class SecurityService
{
    public function __construct(
        private Security $security
    ) {
    }
    
    public function checkUserConnected(): bool
    {
        $user_is_connected = false;
        if ($this->security->getUser()) $user_is_connected = true;
        return $user_is_connected;
    }
}
