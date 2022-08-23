<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $user =
            [
                'username' => 'Malgol',
                'roles' => '["ROLE_USER"]',
                'email' => 'amontekalarmalgol@gmail.com',
                'password' => '$2y$13$D6Ojf57CDHmD5Xz.12iSDu1IKtUQBSH9YLV4i6NxkNEtmG6AAfxqy'
            ];

        $userNew = new User();
        $userNew
            ->setUsername($user["username"])
            ->setEmail($user["email"])
            ->setPassword($user["password"])
            ->setRoles(json_decode($user["roles"]));
        $this->userRepository->add($userNew, true);
    }
}
