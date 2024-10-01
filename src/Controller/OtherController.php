<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OtherController extends AbstractController
{
    #[Route('/other', name: 'app_other')]
    public function index(): Response
    {
        return $this->render('other/abonnements.html.twig', [
            'controller_name' => 'OtherController',
        ]);
    }

    #[Route('/other_category', name: 'app_other_category')]
    public function category(): Response
    {
        return $this->render('other/category.html.twig', [
            'controller_name' => 'OtherController',
        ]);
    }

    #[Route('/other_discover', name: 'app_other_discover')]
    public function discover(): Response
    {
        return $this->render('other/discover.html.twig', [
            'controller_name' => 'OtherController',
        ]);
    }

    #[Route('/lists', name: 'app_other_lists')]
    public function lists(): Response
    {
        return $this->render('other/lists.html.twig', [
            'controller_name' => 'OtherController',
        ]);
    }
}
