<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $descriptif;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $date_fin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $date_facture;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $facture;

    /**
     * @ORM\ManyToOne(targetEntity=Prestataire::class, inversedBy="mission")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;

    /**
     * @ORM\OneToMany(targetEntity=Probleme::class, mappedBy="mission")
     */
    private $probleme;

    public function __construct()
    {
        $this->probleme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->date_facture;
    }

    public function setDateFacture(\DateTimeInterface $date_facture): self
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getFacture()
    {
        return $this->facture;
    }

    public function setFacture($facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    /**
     * @return Collection|Probleme[]
     */
    public function getProbleme(): Collection
    {
        return $this->probleme;
    }

    public function addProbleme(Probleme $probleme): self
    {
        if (!$this->probleme->contains($probleme)) {
            $this->probleme[] = $probleme;
            $probleme->setMission($this);
        }

        return $this;
    }

    public function removeProbleme(Probleme $probleme): self
    {
        if ($this->probleme->removeElement($probleme)) {
            // set the owning side to null (unless already changed)
            if ($probleme->getMission() === $this) {
                $probleme->setMission(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return 'Mission ' . $this->id;
    }
}
