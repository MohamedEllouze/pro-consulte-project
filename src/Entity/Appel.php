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
    private int $id;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: Specialist::class, inversedBy: 'appels')]
    #[ORM\JoinColumn(nullable: false)]
    private Specialist $specialist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSpecialist(): Specialist
    {
        return $this->specialist;
    }
    public function setSpecialist(Specialist $specialist): self
    {
        $this->specialist = $specialist;

        return $this;
    }
}
