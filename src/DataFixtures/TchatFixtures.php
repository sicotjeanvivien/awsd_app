<?php

namespace App\DataFixtures;

use App\Entity\Tchat\TchatConversation;
use App\Entity\Tchat\TchatMessage;
use App\Repository\Tchat\TchatConversationRepository;
use App\Repository\Tchat\TchatMessageRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TchatFixtures extends Fixture
{

    public function __construct(
        private UserRepository $userRepository,
        private TchatMessageRepository $tchatMessageRepository,
        private TchatConversationRepository $tchatConversationRepository
    ) {
    }

    public function load(ObjectManager $manager): void
    {

        $messages = [
            [
                "content" => "hello world",
                "username" => "Malgol"
            ],
            [
                "content" => "hello world",
                "username" => "BotTchat"
            ],
        ];

        // $tchatConversationNew =  new TchatConversation();
        // foreach ($messages as $key => $message) {
        //     $tchatMessageNew =  new TchatMessage();
        //     $user = $this->userRepository->findOneBy(["username" => $message["username"]]);
        //     $tchatMessageNew
        //         ->setContent($message["content"])
        //         ->setUser($user);
        //     $this->tchatMessageRepository->add($tchatMessageNew);
        //     $tchatConversationNew
        //         ->addMessage($tchatMessageNew)
        //         ->addUser($user);
        // }
        // $this->tchatConversationRepository->add($tchatConversationNew);



        $manager->flush();
    }
}
