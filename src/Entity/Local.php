<?php

namespace App\Entity;

use App\Repository\LocalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalRepository::class)
 */
class Local
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToOne(targetEntity=Capacite::class, cascade={"persist", "remove"})
     */
    private $capacite;

    /**
     * @ORM\ManyToOne(targetEntity=TypeLocal::class, inversedBy="locals")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCapacite(): ?Capacite
    {
        return $this->capacite;
    }

    public function setCapacite(?Capacite $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getType(): ?TypeLocal
    {
        return $this->type;
    }

    public function setType(?TypeLocal $type): self
    {
        $this->type = $type;

        return $this;
    }
}
