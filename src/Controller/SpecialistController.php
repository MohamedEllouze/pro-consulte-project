<?php

namespace App\Controller;

use App\Repository\SpecialistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class SpecialistController extends AbstractController
{
    #[Route('/specialist', name: 'user_specialist')]
    public function index(SpecialistRepository $specialistRepository): Response
    {
        return $this->render('specialist/index.html.twig', [
            'specialists' => $specialistRepository->orderByStates(),
        ]);
    }

    #[Route('/specialist/{id}/details', name: 'specialist_details')]
    public function details(SpecialistRepository $specialistRepository, int $id): Response
    {
        return $this->render('specialist/details.html.twig', [
            'specialist' => $specialistRepository->find($id),
        ]);
    }
}
