<?php

namespace App\Controller;

use App\Repository\SpecialistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(SpecialistRepository $specialistRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'specialists' => $specialistRepository->findAll(),
        ]);
    }
}
