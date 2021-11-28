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

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private $reference;

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
    public function toArray()
   {
    return [
        'id' => $this->getId(),
        'Adults' => $this->getAdults(),
        'Enfants' => $this->getEnfants()
    ];
}

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
