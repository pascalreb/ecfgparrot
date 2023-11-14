<?php

namespace App\Controller;

use App\Repository\OpinionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OpinionRepository $repository): Response
    {
        $opinions = $repository->findOpinion1(null);

        return $this->render('pages/home.html.twig', [
            'opinions' => $opinions,
        ]);
    }
}
