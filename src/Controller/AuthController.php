<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/auth', name: 'app_auth')]
    public function index(): Response
    {
        return $this->render('auth/login.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    #[Route('/auth_confirm', name: 'app_auth_confirm')]
    public function confirm(): Response
    {
        return $this->render('auth/confirm.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    #[Route('/auth_default', name: 'app_auth_default')]
    public function default(): Response
    {
        return $this->render('auth/default.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    #[Route('/auth_forgot', name: 'app_auth_forgot')]
    public function forgot(): Response
    {
        return $this->render('auth/forgot.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    #[Route('/auth_register', name: 'app_auth_register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    #[Route('/auth_reset', name: 'app_auth_reset')]
    public function reset(): Response
    {
        return $this->render('auth/reset.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }

    #[Route('/auth_upload', name: 'app_auth_upload')]
    public function upload(): Response
    {
        return $this->render('auth/upload.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }
    
}
