<?php

namespace App\Controller;

use App\Entity\Specialist;
use App\Form\SpecialistFormType;
use App\Repository\AppelRepository;
use App\Repository\SpecialistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/list', name: 'admin_specialist')]
    public function index(SpecialistRepository $specialistRepository, AppelRepository $appelRepository): Response
    {
        return $this->render('specialist/index.html.twig', [
            'specialists' => $specialistRepository->orderByStates(),
            'appels' => $appelRepository->findAll(),

        ]);
    }

    #[Route('/add', name: 'admin_add_specialist')]
    public function addSpecialist(Request $request, EntityManagerInterface $em): Response
    {
        $specialist = new Specialist();
        $form = $this->createForm(SpecialistFormType::class, $specialist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the specialist to the database
            $em->persist($specialist);
            $em->flush();
            $this->addFlash('success', 'Psychologue ajouté avec succees');

            // Redirect or render success message
            return $this->redirectToRoute('admin_specialist');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
