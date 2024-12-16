<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route(path: '/login', name: 'app_login', methods: ['GET', 'POST'])]
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

    #[Route(path: '/register', name: 'page_register', methods: ['GET', 'POST'])]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }

    #[Route(path: '/forgot', name: 'page_forgot_password', methods: ['GET'])]
    public function forgotPassword(): Response
    {
        return $this->render('auth/forgot.html.twig');
    }

    #[Route(path: '/forgot/submit', name: 'submit_forgot_password', methods: ['POST'])]
    public function handleForgotPassword(Request $request, EntityManagerInterface $entityManager): Response
    {
        $email = $request->get('_email');

        if (!$email) {
            $this->addFlash('error', 'Veuillez entrer une adresse email.');
            return $this->redirectToRoute('page_forgot_password');
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            $this->addFlash('error', 'Aucun utilisateur trouvé avec cette adresse email.');
            return $this->redirectToRoute('page_forgot_password');
        }

        $resetToken = Uuid::v4();
        $user->setResetToken($resetToken);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Un email de réinitialisation a été envoyé.');
        return $this->redirectToRoute('page_forgot_password');
    }

    #[Route(path: '/reset/{token}', name: 'page_reset_password', methods: ['GET', 'POST'])]
    public function resetPassword(string $token, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            $this->addFlash('error', 'Token de réinitialisation invalide.');
            return $this->redirectToRoute('page_forgot_password');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('password');

            if (!$newPassword) {
                $this->addFlash('error', 'Veuillez entrer un nouveau mot de passe.');
                return $this->redirectToRoute('page_reset_password', ['token' => $token]);
            }

            $user->setPassword(password_hash($newPassword, PASSWORD_BCRYPT));
            $user->setResetToken(null);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('auth/reset.html.twig', ['token' => $token]);
    }
}
