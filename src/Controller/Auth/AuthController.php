<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;

class AuthController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $email = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'email' => $email,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/register', name: 'page_register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }

    #[Route(path: '/forgot', name: 'page_forgot_password')]
    public function forgotPassword(): Response
    {
        return $this->render('auth/forgot.html.twig');
    }

    #[Route(path: '/reset', name: 'page_reset_password')]
    public function resetPassword(): Response
    {
        return $this->render('auth/reset.html.twig');
    }

    #[Route(path: '/confirm', name: 'page_confirm_account')]
    public function confirmAccount(): Response
    {
        return $this->render('auth/confirm.html.twig');
    }

    #[Route(path: '/dashboard', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        $user = $this->security->getUser();
        $username = $user ? $user->getUsername() : 'Invité';

        return $this->render('right-sidebar.html.twig', [
            'username' => $username,
        ]);
    }
}
