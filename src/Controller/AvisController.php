<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis = $form->getData();

            $manager->persist($avis);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre avis a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_home');
        }

        return $this->render('pages/avis.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
