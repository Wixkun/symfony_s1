<?php

declare(strict_types=1);

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\SubscriptionRepository;

class SubscriptionController extends AbstractController
{
    #[Route(path: '/subscriptions', name: 'page_subscriptions')]
    public function subscriptions(
        SubscriptionRepository $subscriptionRepository,
    ): Response {
        $subscriptions = $subscriptionRepository->findAll();
        $currentSubscription = null;

        $user = $this->getUser();
        if ($user && method_exists($user, 'getSubscription')) {
            $currentSubscription = $user->getSubscription(); 
        }

        return $this->render('other/abonnements.html.twig', [
            'subscriptions' => $subscriptions,
            'currentSubscription' => $currentSubscription,
        ]);
    }
}
