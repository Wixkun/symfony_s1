<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        return $this->render('movie/detail.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/movie_serie', name: 'app_movie_serie')]
    public function detail(): Response
    {
        return $this->render('movie/detail_serie.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }
}
