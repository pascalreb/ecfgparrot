<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Form\OpinionType;
use App\Repository\OpinionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OpinionController extends AbstractController
{
    /*
    * This controller displays all opinions with a pagination for users
    */
    #[IsGranted('ROLE_USER')]
    #[Route('/opinion', name: 'app_opinion', methods: ['GET', 'POST'])]
    public function index(OpinionRepository $repository, Request $request, PaginatorInterface $paginator, EntityManagerInterface $manager): Response
    {
        $opinions = $paginator->paginate(
            $repository->findOpinion(null), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $opinion = new Opinion();
        $form = $this->createForm(OpinionType::class, $opinion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $opinion = $form->getData();

            $manager->persist($opinion);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'avis a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_opinion');
        }

        return $this->render('pages/opinion/index.html.twig', [
            'opinions' => $opinions,
            'form' => $form->createView()
        ]);
    }

    /*
     * This controller displays the opinion form for clients
     */
    #[Route('/opinion/public', name: 'app_publicOpinion')]
    public function indexPublic(EntityManagerInterface $manager, Request $request): Response
    {
        $opinion = new Opinion();
        $form = $this->createForm(OpinionType::class, $opinion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $opinion = $form->getData();

            $manager->persist($opinion);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre avis a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_publicOpinion');
        }

        return $this->render('pages/opinion/index_public.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /*
     * This controller allows to add an opinion for users
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/opinion/new', name: 'app_newOpinion', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $opinion = new Opinion();
        $form = $this->createForm(OpinionType::class, $opinion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $opinion = $form->getData();

            $manager->persist($opinion);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre avis a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_opinion');
        }

        return $this->render('pages/opinion/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /*
     * This controller displays approved opinions on the home page
     */
    #[Route('/', name: 'app_showOpinion', methods: ['GET'])]
    public function show(OpinionRepository $repository, Opinion $opinion): Response
    {
        $opinions = $repository->findOpinion1(null);

        return $this->render('pages/home.html.twig', [
            'opinions' => $opinions,
        ]);
    }

    /*
     * This controller allows to validate an opinion
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/opinion/edit/{id}', name: 'app_editOpinion', methods: ['GET'])]
    public function update(EntityManagerInterface $manager, Opinion $opinion): Response
    {
        $opinion->setIsApproved('1');
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'avis a été validé avec succès !'
        );

        return $this->redirectToRoute('app_opinion');
    }

    /*
     * This controller allows to delete an opinion
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/opinion/delete/{id}', name: 'app_deleteOpinion', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Opinion $opinion): Response
    {
        $manager->remove($opinion);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'avis a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_opinion');
    }
}
