<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\Entity\UserService;
use App\Service\SecurityService;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route("/security")]
class SecurityController extends AbstractController
{
    public function __construct(
        private RequestStack $request,
        private SecurityService $securityService,
        private UserService $userService
    ) {
    }

    #[Route('/login', name: 'security_login', methods: ["POST"])]
    public function login(#[CurrentUser] ?User $user): JsonResponse
    {
        $response =  $this->json([
            'message' => 'missing credentials',
        ], JsonResponse::HTTP_UNAUTHORIZED);

        if ($user) {
            $response = $this->json([
                'username'  => $user->getUserIdentifier(),
                'token' => $this->securityService->genaratedAuthToken($user)
            ]);
        }
        return  $response;
    }

    #[Route('/logout', name: 'security_logout', methods: ["GET"])]
    public function logout(): Response
    {
        return $this->redirectToRoute("app_home");
    }

    #[Route("/checked", name: "security_check", methods: ["POST"])]
    public function checkUserConnected(): JsonResponse
    {
        if (empty($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'))) {
            return $this->json([
                'id' => $this->getUser()->getId(),
                'username'  => $this->getUser()->getUserIdentifier(),
                'token' => $this->securityService->genaratedAuthToken($this->getUser()),
                '@id' => $this->generateUrl(
                    "api_users_get_item",
                    ["id" => $this->getUser()->getId()],
                    UrlGeneratorInterface::ABSOLUTE_PATH
                )
            ]);
        }
    }

    #[Route("/signIN", name: "security_signin", methods: ["POST"])]
    public function signIn(): JsonResponse
    {

        $error =  false;
        $message = "Les informations transmises comportent des erreurs. Le nom d'utilisateur ou l'adresse email sont déjà utilisés.";
        $data =  json_decode($this->request->getCurrentRequest()->getContent());
        if (!empty($data) && $this->userService->add($data)) {
            $error =  true;
            $message = "L'utilsateur a été créé.";
        }

        return $this->json([
            "error" => $error,
            "message" => $message
        ]);
    }
}
