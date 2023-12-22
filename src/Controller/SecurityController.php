<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\HourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /*
     * This controller allows to login an user
     */
    #[Route('/connexion', name: 'app_loginSecurity', methods: ['GET', 'POST'])]
    public function login(
        AuthenticationUtils $authenticationUtils,
        HourRepository $hourRepository
    ): Response {
        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'hours' => $hourRepository->findAll(),
        ]);
    }

    /*
     * This controller allows to logout an user
     */
    #[Route('/deconnexion', name: 'app_logoutSecurity')]
    public function logout()
    {
        // Nothing to do here...go to security.yaml
    }

    /*
     * This controller allows to create an user
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/inscription', name: 'app_registrationSecurity', methods: ['GET', 'POST'])]
    public function registration(
        Request $request,
        EntityManagerInterface $manager,
        HourRepository $hourRepository
    ): Response {
        $user = new User();
        $user->setRoles(['ROLE_USER']);

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $this->addFlash(
                'success',
                'Votre compte a été créé avec succès !'
            );

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_loginSecurity');
        }

        return $this->render('pages/security/registration.html.twig', [
            'form' => $form->createView(),
            'hours' => $hourRepository->findAll(),
        ]);
    }
}
