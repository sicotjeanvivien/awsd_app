<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\SecurityService;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route("/security")]
class SecurityController extends AbstractController
{
    public function __construct(
        private RequestStack $request,
        private SecurityService $securityService
    ) {
    }

    #[Route('/login', name: 'security_login', methods: ["POST"])]
    public function index(#[CurrentUser] ?User $user): JsonResponse
    {
        $response =  $this->json([
            'message' => 'missing credentials',
        ], JsonResponse::HTTP_UNAUTHORIZED);

        if ($user) {
            $response = $this->json([
                'user'  => $user->getUserIdentifier(),
                'token' => "..."
            ]);
        }
        return  $response;
    }

    #[Route("/checked", name: "security_check", methods: ["POST"])]
    public function checkUserConnected(): JsonResponse
    {
        return $this->json([
            "user_is_connected" => $this->securityService->checkUserConnected()
        ]);
    }
}
