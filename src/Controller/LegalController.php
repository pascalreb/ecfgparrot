<?php

namespace App\Controller;

use App\Repository\HourRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LegalController extends AbstractController
{
    #[Route('/legal', name: 'app_legal')]
    public function index(
        HourRepository $hourRepository
    ): Response {
        return $this->render(
            'pages/legal/legal_notice.html.twig',
            [
                'hours' => $hourRepository->findAll(),
            ]
        );
    }
}
