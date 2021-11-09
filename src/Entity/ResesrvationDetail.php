<?php

namespace App\Entity;

use App\Repository\ResesrvationDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResesrvationDetailRepository::class)
 */
class ResesrvationDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixCalcule;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="resesrvationDetails")
     */
    private $reservation;

    /**
     * @ORM\OneToOne(targetEntity=Local::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $local;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPrixCalcule(): ?float
    {
        return $this->prixCalcule;
    }

    public function setPrixCalcule(?float $prixCalcule): self
    {
        $this->prixCalcule = $prixCalcule;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(Local $local): self
    {
        $this->local = $local;

        return $this;
    }
}
