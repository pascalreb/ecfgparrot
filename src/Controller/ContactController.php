<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\CarRepository;
use App\Repository\HourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        HourRepository $hourRepository
    ): Response {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_contact');
        }


        return $this->render('pages/contact/index.html.twig', [
            'form' => $form->createView(),
            'hours' => $hourRepository->findAll(),
        ]);
    }

    /*
     * This controller allows to display a contact form about a car
     */
    #[Route('/car/contact/{id}', name: 'app_contactOccasions', methods: ['GET', 'POST'])]
    public function contactForCar(
        Car $car,
        CarRepository $repository,
        int $id,
        Request $request,
        EntityManagerInterface $manager,
        HourRepository $hourRepository
    ): Response {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setCar($car);
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_publicOccasions');
        }

        return $this->render('pages/contact/ContactForCar.html.twig', [
            'id' => $id,
            'car' => $car,
            'form' => $form->createView(),
            'hours' => $hourRepository->findAll(),
        ]);
    }
}
