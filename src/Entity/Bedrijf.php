<?php

namespace App\Entity;

use App\Repository\BedrijfRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BedrijfRepository::class)]
class Bedrijf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $kleur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getKleur(): ?string
    {
        return $this->kleur;
    }

    public function setKleur(string $kleur): self
    {
        $this->kleur = $kleur;

        return $this;
    }
}
