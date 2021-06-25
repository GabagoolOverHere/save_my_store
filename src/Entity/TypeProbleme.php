<?php

namespace App\Entity;

use App\Repository\TypeProblemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeProblemeRepository::class)
 */
class TypeProbleme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $violation_code;

    /**
     * @ORM\OneToMany(targetEntity=Probleme::class, mappedBy="typeProbleme", orphanRemoval=true)
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

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getViolationCode(): ?string
    {
        return $this->violation_code;
    }

    public function setViolationCode(string $violation_code): self
    {
        $this->violation_code = $violation_code;

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
            $probleme->setTypeProbleme($this);
        }

        return $this;
    }

    public function removeProbleme(Probleme $probleme): self
    {
        if ($this->probleme->removeElement($probleme)) {
            // set the owning side to null (unless already changed)
            if ($probleme->getTypeProbleme() === $this) {
                $probleme->setTypeProbleme(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->intitule;
    }
}
