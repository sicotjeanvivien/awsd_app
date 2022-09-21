<?php

namespace App\Controller\API;

use App\Repository\Organisator\OrganisatorTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class OrganisatorTaskController extends AbstractController
{

    public function __construct(
        private OrganisatorTaskRepository $organisatorTaskRepository,
        private RequestStack $requestStack
    ) {
    }

    public function __invoke()
    {
        $weekNumber = $this->requestStack->getCurrentRequest()->get("weekNumber");
        return $this->organisatorTaskRepository->findBy(
            ["user" => $this->getUser(), "weekNumber" => $weekNumber],
            ["date" => "ASC"]
        );
    }
}
