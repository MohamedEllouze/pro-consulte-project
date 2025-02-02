<?php

namespace App\Tests\Controller;

use App\Controller\AdminController;
use App\Repository\AppelRepository;
use App\Repository\SpecialistRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment;

class AdminControllerTest extends TestCase
{
    public function testIndex(): void
    {
        // Mock the repositories
        $specialistRepositoryMock = $this->createMock(SpecialistRepository::class);
        $appelRepositoryMock = $this->createMock(AppelRepository::class);

        // Set up the expected behavior for the repository methods
        $specialistRepositoryMock->expects($this->once())
            ->method('findAllOrdredByState')
            ->willReturn(['specialist1', 'specialist2']); // Replace with sample data

        $appelRepositoryMock->expects($this->once())
            ->method('findAllWithSpecialists')
            ->willReturn(['appel1', 'appel2']); // Replace with sample data

        // Mock the Twig environment
        $twigMock = $this->createMock(Environment::class);
        $twigMock->expects($this->once())
            ->method('render')
            ->with(
                'specialist/index.html.twig',
                [
                    'specialists' => ['specialist1', 'specialist2'],
                    'appels' => ['appel1', 'appel2'],
                ]
            )
            ->willReturn('Rendered template content');

        $controller = new AdminController();

        // Mock the container to inject the Twig service
        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->expects($this->once())
            ->method('has')
            ->with('twig')
            ->willReturn(true);
        $containerMock->expects($this->once())
            ->method('get')
            ->with('twig')
            ->willReturn($twigMock);

        $controller->setContainer($containerMock);

        $response = $controller->index($specialistRepositoryMock, $appelRepositoryMock);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals('Rendered template content', $response->getContent());
    }
}
