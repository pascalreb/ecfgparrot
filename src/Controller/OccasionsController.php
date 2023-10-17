<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OccasionsController extends AbstractController
{
    /*
    * This controller displays all cars with a pagination
    */
    #[Route('/car', name: 'app_occasions')]
    public function index(CarRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $cars = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/car/index.html.twig', [
            'cars' => $cars
        ]);
    }
    /*
     * This controller allows to create an ingredient
     */
    #[Route('/car/new', name: 'app_newOccasions', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre voiture a été créée avec succès !'
            );

            return $this->redirectToRoute('app_occasions');
        }

        return $this->render('pages/car/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /*
     * This controller allows to modify a car
     */
    #[Route('/car/edition/{id}', name: 'app_editOccasions', methods: ['GET', 'POST'])]
    public function edit(CarRepository $repository, int $id, Request $request, EntityManagerInterface $manager): Response
    {
        $car = $repository->findOneBy(["id" => $id]);
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre voiture a été modifiée avec succès !'
            );

            return $this->redirectToRoute('app_occasions');
        }

        return $this->render('pages/car/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /*
     * This controller allows to delete a car
     */
    #[Route('/car/delete/{id}', name: 'app_deleteOccasions', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Car $car): Response
    {
        $manager->remove($car);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre voiture a été supprimée avec succès !'
        );

        return $this->redirectToRoute('app_occasions');
    }
}
