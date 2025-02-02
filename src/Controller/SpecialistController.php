<?php

namespace App\Controller;

use App\Entity\Specialist;
use App\Form\SpecialistFormType;
use App\Repository\SpecialistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SpecialistController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(SpecialistRepository $specialistRepository): Response
    {
        return $this->render('specialist/index.html.twig', [
            'specialists' => $specialistRepository->findAllOrdredByState(),
        ]);
    }

    #[Route('/{id}/details', name: 'specialist_details')]
    public function details(SpecialistRepository $specialistRepository, int $id): Response
    {
        $specialist = $specialistRepository->find($id);
        if (!$specialist) {
            throw new NotFoundHttpException("specialist not found!");
        }

        return $this->render('specialist/details.html.twig', [
            'specialist' => $specialist,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/add', name: 'add_specialist')]
    public function addSpecialist(Request $request, EntityManagerInterface $em): Response
    {
        $specialist = new Specialist();
        $form = $this->createForm(SpecialistFormType::class, $specialist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($specialist);
            $em->flush();
            $this->addFlash('success', 'Psychologue ajouté avec succees');

            return $this->redirectToRoute('admin_specialist');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
