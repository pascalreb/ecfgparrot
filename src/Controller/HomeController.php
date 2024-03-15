<?php

namespace App\Controller;

use App\Repository\HourRepository;
use App\Repository\OpinionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OpinionRepository $repository, PaginatorInterface $paginator, Request $request, HourRepository $hourRepository): Response
    {

        $opinions = $paginator->paginate(
            $repository->findApprovedOpinions(null), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('pages/home.html.twig', [
            'opinions' => $opinions,
            'hours' => $hourRepository->findAll(),
        ]);
    }
}
