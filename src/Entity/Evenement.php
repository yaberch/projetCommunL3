<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSoiree;

    /**
     * @ORM\Column(type="date")
     */
    private $jourEvent;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heureFin;

    /**
     * @ORM\Column(type="float")
     */
    private $noteMoyenne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeMusique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $snap;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSoiree(): ?string
    {
        return $this->nomSoiree;
    }

    public function setNomSoiree(string $nomSoiree): self
    {
        $this->nomSoiree = $nomSoiree;

        return $this;
    }

    public function getJourEvent(): ?\DateTimeInterface
    {
        return $this->jourEvent;
    }

    public function setJourEvent(\DateTimeInterface $jourEvent): self
    {
        $this->jourEvent = $jourEvent;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getNoteMoyenne(): ?float
    {
        return $this->noteMoyenne;
    }

    public function setNoteMoyenne(float $noteMoyenne): self
    {
        $this->noteMoyenne = $noteMoyenne;

        return $this;
    }

    public function getTypeMusique(): ?string
    {
        return $this->typeMusique;
    }

    public function setTypeMusique(string $typeMusique): self
    {
        $this->typeMusique = $typeMusique;

        return $this;
    }

    public function getInsta(): ?string
    {
        return $this->insta;
    }

    public function setInsta(?string $insta): self
    {
        $this->insta = $insta;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getSnap(): ?string
    {
        return $this->snap;
    }

    public function setSnap(?string $snap): self
    {
        $this->snap = $snap;

        return $this;
    }
}
