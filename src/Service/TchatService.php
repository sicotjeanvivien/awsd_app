<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\Tchat\TchatConversationRepository;

class TchatService
{
    public function __construct(
        private TchatConversationRepository $tchatConversationRepository
    ) {
    }

    
    public function checkIfExitConversationWithBot(User $user)
    {

            $this->tchatConversationRepository->count([""]);
        return true;
    }
}
