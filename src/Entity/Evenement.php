<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlace;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeDeMusique;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="evenements")
     */
    private $lieu;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="participeA")
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="aOrganise")
     */
    private $organisateur;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="evenement")
     */
    private $avis;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="evenement")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="evenement")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="evenement")
     */
    private $videos;

    /**
     * @ORM\OneToMany(targetEntity=OffreTarif::class, mappedBy="evenement")
     */
    private $offreTarifs;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->offreTarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(int $nbPlace): self
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getTypeDeMusique(): ?string
    {
        return $this->typeDeMusique;
    }

    public function setTypeDeMusique(string $typeDeMusique): self
    {
        $this->typeDeMusique = $typeDeMusique;

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

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    public function getOrganisateur(): ?User
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?User $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setEvenement($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getEvenement() === $this) {
                $avi->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setEvenement($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getEvenement() === $this) {
                $photo->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setEvenement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEvenement() === $this) {
                $reservation->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setEvenement($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getEvenement() === $this) {
                $video->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OffreTarif[]
     */
    public function getOffreTarifs(): Collection
    {
        return $this->offreTarifs;
    }

    public function addOffreTarif(OffreTarif $offreTarif): self
    {
        if (!$this->offreTarifs->contains($offreTarif)) {
            $this->offreTarifs[] = $offreTarif;
            $offreTarif->setEvenement($this);
        }

        return $this;
    }

    public function removeOffreTarif(OffreTarif $offreTarif): self
    {
        if ($this->offreTarifs->removeElement($offreTarif)) {
            // set the owning side to null (unless already changed)
            if ($offreTarif->getEvenement() === $this) {
                $offreTarif->setEvenement(null);
            }
        }

        return $this;
    }
}
