<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Image;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OccasionsController extends AbstractController
{
    /*
    * This controller displays all cars with a pagination
    */
    #[IsGranted('ROLE_USER')]
    #[Route('/car', name: 'app_occasions')]
    public function index(ImageRepository $image, CarRepository $repository, PaginatorInterface $paginator, Request $request): Response
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
     * This controller displays all recipes which are public
     */
    #[Route('/car/public', name: 'app_publicOccasions', methods: ['GET'])]
    public function indexPublic(ImageRepository $image, CarRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $cars = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/car/index_public.html.twig', [
            'cars' => $cars,
        ]);
    }

    /*
     * This controller allows to display the details of a car
     */
    #[Route('/car/editionDetails/{id}', name: 'app_editDetailsOccasions', methods: ['GET'])]
    public function editDetails(CarRepository $repository, int $id): Response
    {
        $car = $repository->findOneBy(["id" => $id]);

        return $this->render('pages/car/editDetails.html.twig', [
            'car' => $car,
        ]);
    }

    /*
     * This controller allows to create an ingredient
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/car/new', name: 'app_newOccasions', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            // On récupère les images transmises
            $images = $form->get('images')->getData();

            // On boucle sur les images
            foreach ($images as $image) {
                // On génère un nouveaeu nom de fichier pour éviter que 2 images aient le même nom
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On stocke l'image (son nom) dans la bdd
                $img = new Image();
                $img->setName($fichier);
                $car->addImage($img);
            }

            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre véhicule a été créé avec succès !'
            );

            return $this->redirectToRoute('app_occasions');
        }

        return $this->render('pages/car/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /*
     * This controller allows to modify a car
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/car/edition/{id}', name: 'app_editOccasions', methods: ['GET', 'POST'])]
    public function edit(ImageRepository $image, CarRepository $repository, int $id, Request $request, EntityManagerInterface $manager): Response
    {
        $car = $repository->findOneBy(["id" => $id]);
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            // On récupère les images transmises
            $images = $form->get('images')->getData();
            // On boucle sur les images
            foreach ($images as $image) {
                // On génère un nouveaeu nom de fichier pour éviter que 2 images aient le même nom
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On stocke l'image (son nom) dans la bdd
                $img = new Image();
                $img->setName($fichier);
                $car->addImage($img);
            }

            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre véhicule a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_occasions');
        }

        return $this->render('pages/car/edit.html.twig', [
            'image' => $image,
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    /*
     * This controller allows to delete a car
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/car/delete/{id}', name: 'app_deleteOccasions', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Car $car): Response
    {
        $manager->remove($car);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre véhicule a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_occasions');
    }

    /*
     * This controller allows to delete images of car
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/car/delete/image/{id}', name: 'app_deleteImageOccasions', methods: ['DELETE'])]
    public function deleteImage(Image $image, Request $request, EntityManagerInterface $manager,)
    {
        $data = json_decode($request->getContent(), true);
        // On vérifie si le token est valide
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            // On récupère le nom de l'image
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory') . '/' . $nom);

            // On supprime l'entrée de la base
            $manager->remove($image);
            $manager->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }
}
