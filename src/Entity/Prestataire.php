<?php

namespace App\Entity;

use App\Repository\PrestataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PrestataireRepository::class)
 */
class Prestataire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nom;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $immeuble;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $rue;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $code_postal;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\NotBlank
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\NotBlank
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tarif;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThanOrEqual(9999999999)
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity=PatronPrestataire::class, inversedBy="prestataire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patronPrestataire;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="prestataire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quartier;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="prestataire", orphanRemoval=true)
     */
    private $mission;

    public function __construct()
    {
        $this->mission = new ArrayCollection();
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

    public function getImmeuble(): ?string
    {
        return $this->immeuble;
    }

    public function setImmeuble(string $immeuble): self
    {
        $this->immeuble = $immeuble;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getTarif()
    {
        return $this->tarif;
    }

    public function setTarif($tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getPatronPrestataire(): ?PatronPrestataire
    {
        return $this->patronPrestataire;
    }

    public function setPatronPrestataire(?PatronPrestataire $patronPrestataire): self
    {
        $this->patronPrestataire = $patronPrestataire;

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMission(): Collection
    {
        return $this->mission;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->mission->contains($mission)) {
            $this->mission[] = $mission;
            $mission->setPrestataire($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->mission->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getPrestataire() === $this) {
                $mission->setPrestataire(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
