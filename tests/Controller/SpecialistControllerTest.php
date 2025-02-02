<?php

namespace App\Tests\Controller;

use App\Controller\SpecialistController;
use App\Entity\Specialist;
use App\Repository\SpecialistRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Environment;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SpecialistControllerTest extends TestCase
{
    private $twigMock;
    private $specialistRepositoryMock;
    private $formFactoryMock;
    private $urlGeneratorMock;
    private $authorizationCheckerMock;
    private $sessionMock;
    private $containerMock;

    protected function setUp(): void
    {
        $this->twigMock = $this->createMock(Environment::class);
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->specialistRepositoryMock = $this->createMock(SpecialistRepository::class);
        $this->formFactoryMock = $this->createMock(FormFactoryInterface::class);
        $this->urlGeneratorMock = $this->createMock(UrlGeneratorInterface::class);
        $this->authorizationCheckerMock = $this->createMock(AuthorizationCheckerInterface::class);
        $this->sessionMock = $this->createMock(Session::class);
        $this->flashBagMock = $this->createMock(FlashBagInterface::class);

        $this->containerMock = $this->createMock(ContainerInterface::class);
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->willReturnMap([
            ['twig', $this->twigMock],
            ['form.factory', $this->formFactoryMock],
            ['router', $this->urlGeneratorMock],
            ['security.authorization_checker', $this->authorizationCheckerMock],
            ['session', $this->sessionMock],
        ]);
    }

    public function testDetails(): void
    {
        // Mock the repository to return a specialist
        $specialist = new Specialist();
        $this->specialistRepositoryMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($specialist);

        // Mock Twig to render the template
        $this->twigMock->expects($this->once())
            ->method('render')
            ->with('specialist/details.html.twig', ['specialist' => $specialist])
            ->willReturn('Rendered template content');

        $controller = new SpecialistController();
        $controller->setContainer($this->containerMock);
        $response = $controller->details($this->specialistRepositoryMock, 1);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Rendered template content', $response->getContent());
    }

    public function testDetailsNotFound(): void
    {
        // Mock the repository to return null (specialist not found)
        $this->specialistRepositoryMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn(null);

        $controller = new SpecialistController();
        $controller->setContainer($this->containerMock);

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('specialist not found!');

        $controller->details($this->specialistRepositoryMock, 1);
    }
}
