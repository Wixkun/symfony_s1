<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin_add_films', name: 'app_admin_add_films')]
    public function addFilm(): Response
    {
        return $this->render('admin/admin_add_films.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin_films', name: 'app_admin_films')]
    public function film(): Response
    {
        return $this->render('admin/admin_films.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin_users', name: 'app_admin_users')]
    public function users(): Response
    {
        return $this->render('admin/admin_users.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
