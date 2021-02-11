<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
    private $pathCNI;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPathCNI(): ?string
    {
        return $this->pathCNI;
    }

    public function setPathCNI(string $pathCNI): self
    {
        $this->pathCNI = $pathCNI;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
