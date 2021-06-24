<?php

namespace App\Entity;

use App\Repository\ProblemeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProblemeRepository::class)
 */
class Probleme
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="probleme")
     */
    private $restaurant;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="probleme")
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProbleme::class, inversedBy="probleme")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeProbleme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getTypeProbleme(): ?TypeProbleme
    {
        return $this->typeProbleme;
    }

    public function setTypeProbleme(?TypeProbleme $typeProbleme): self
    {
        $this->typeProbleme = $typeProbleme;

        return $this;
    }

    public function __toString(): string
    {
        return $this->intitule . ' ' . $this->typeProbleme;
    }
}
