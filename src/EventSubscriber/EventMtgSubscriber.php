<?php

namespace App\EventSubscriber;

use App\Repository\MTG\MtgCardRepository;
use App\Repository\MTG\MtgSetRepository;
use App\Service\MtgService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EventMtgSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private MtgSetRepository $mtgSetRepository,
        private MtgCardRepository $mtgCardRepository,

        private MtgService $mtgService
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $eventRequest = $event->getRequest();
        $_route =  $eventRequest->get("_route");
        $extension = $this->mtgSetRepository->findOneBy(["code" => $eventRequest->query->get("mtgSet_code")]);
        if ($_route === "api_mtg_cards_get_collection" && !empty($extension)) {
            if (!$this->mtgCardRepository->count(["mtgSet"=> $extension])) {
                $this->mtgService->loadingCardBySet($extension);                
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
