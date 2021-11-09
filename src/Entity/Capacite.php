<?php

namespace App\Entity;

use App\Repository\CapaciteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CapaciteRepository::class)
 */
class Capacite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $adults;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $enfants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdults(): ?int
    {
        return $this->adults;
    }

    public function setAdults(?int $adults): self
    {
        $this->adults = $adults;

        return $this;
    }

    public function getEnfants(): ?int
    {
        return $this->enfants;
    }

    public function setEnfants(?int $enfants): self
    {
        $this->enfants = $enfants;

        return $this;
    }
}
