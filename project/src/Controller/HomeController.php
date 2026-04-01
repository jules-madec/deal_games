<?php

namespace App\Controller;

use App\Repository\AnnouncementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'announcements' => $announcementRepository->findBy(['isPublished' => true]),
        ]);
    }
}
