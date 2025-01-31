<?php

namespace App\Controller;

use App\Entity\Appel;
use App\Entity\Specialist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/appel')]
class AppelController extends AbstractController
{
    #[Route('/add', name: 'add_appel', methods: ["POST"])]
    public function addAppel(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $specialistId = $request->request->get('id');

        $specialist = $em->getRepository(Specialist::class)->find($specialistId);
        if (!$specialist) {
            return new JsonResponse(['success' => false, 'message' => 'Spécialiste non trouvé'], 404);
        }

        $appel = new Appel();
        $appel->setDate(new \DateTime());
        $appel->setSpecialist($specialist);
        $em->persist($appel);
        $em->flush();

        return new JsonResponse(['success' => true, 'message' => 'Appel ajouté avec succès !']);
    }

    #[Route('/list', name: 'list_appels')]
    public function listAppels(EntityManagerInterface $em): Response
    {
        $appels = $em->getRepository(Appel::class)->findAll();

        return $this->render('appel/index.html.twig', [
            'appels' => $appels,
        ]);
    }
}
