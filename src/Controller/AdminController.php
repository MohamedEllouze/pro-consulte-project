<?php

namespace App\Controller;

use App\Repository\AppelRepository;
use App\Repository\SpecialistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/list', name: 'admin_specialist')]
    public function index(SpecialistRepository $specialistRepository, AppelRepository $appelRepository): Response
    {
        return $this->render('specialist/index.html.twig', [
            'specialists' => $specialistRepository->findAllOrdredByState(),
            'appels' => $appelRepository->findAllWithSpecialists(),

        ]);
    }
}
