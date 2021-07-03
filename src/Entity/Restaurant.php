<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
     * @ORM\Column(type="string", length=255)
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
     * @ORM\Column(type="bigint")
     * @Assert\LessThanOrEqual(9999999999)
     */
    private $tel;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity=PatronRestaurant::class, inversedBy="restaurant")
     * @ORM\JoinColumn(nullable=true)
     */
    private $patronRestaurant;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="restaurant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quartier;

    /**
     * @ORM\OneToMany(targetEntity=Probleme::class, mappedBy="restaurant")
     */
    private $probleme;

    /**
     * @ORM\Column(type="integer")
     */
    private $camis;

    public function __construct()
    {
        $this->probleme = new ArrayCollection();
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

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

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

    public function getPatronRestaurant(): ?PatronRestaurant
    {
        return $this->patronRestaurant;
    }

    public function setPatronRestaurant(?PatronRestaurant $patronRestaurant): self
    {
        $this->patronRestaurant = $patronRestaurant;

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
            $probleme->setRestaurant($this);
        }

        return $this;
    }

    public function removeProbleme(Probleme $probleme): self
    {
        if ($this->probleme->removeElement($probleme)) {
            // set the owning side to null (unless already changed)
            if ($probleme->getRestaurant() === $this) {
                $probleme->setRestaurant(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getCamis(): ?int
    {
        return $this->camis;
    }

    public function setCamis(int $camis): self
    {
        $this->camis = $camis;

        return $this;
    }
}
