<?php

namespace App\Tests\Controller;

use App\Controller\AppelController;
use App\Entity\Appel;
use App\Entity\Specialist;
use App\Repository\SpecialistRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppelControllerTest extends TestCase
{
    public function testAddAppelSuccess(): void
    {
        // Mock the EntityManager
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        // Mock the Specialist repository
        $specialistRepositoryMock = $this->createMock(SpecialistRepository::class);
        $specialistMock = $this->createMock(Specialist::class);

        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Specialist::class)
            ->willReturn($specialistRepositoryMock);

        $specialistRepositoryMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($specialistMock);

        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Appel::class));
        $entityManagerMock->expects($this->once())
            ->method('flush');

        $request = new Request([], ['id' => 1]); // Simulate a POST request with 'id' parameter

        $controller = new AppelController();
        $response = $controller->addAppel($request, $entityManagerMock);

        // Assert the response
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            ['success' => true, 'message' => 'Appel ajouté avec succès !'],
            json_decode($response->getContent(), true)
        );
    }

    public function testAddAppelSpecialistNotFound(): void
    {
        // Mock the EntityManager
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        // Mock the Specialist repository
        $specialistRepositoryMock = $this->createMock(SpecialistRepository::class);

        // Mock the EntityManager to return the Specialist repository
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Specialist::class)
            ->willReturn($specialistRepositoryMock);

        $specialistRepositoryMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn(null);

        $request = new Request([], ['id' => 1]); // Simulate a POST request with 'id' parameter

        $controller = new AppelController();
        $response = $controller->addAppel($request, $entityManagerMock);

        // Assert the response
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(
            ['success' => false, 'message' => 'Spécialiste non trouvé'],
            json_decode($response->getContent(), true)
        );
    }
}
