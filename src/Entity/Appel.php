<?php

namespace App\Entity;

use App\Repository\AppelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppelRepository::class)]
class Appel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\ManyToOne(targetEntity: Specialist::class, inversedBy: 'appels')]
    #[ORM\JoinColumn(nullable: false)]
    private $speclialist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSpeclialist(): ?Specialist
    {
        return $this->speclialist;
    }

    public function setSpeclialist(?Specialist $speclialist): self
    {
        $this->speclialist = $speclialist;

        return $this;
    }
}
