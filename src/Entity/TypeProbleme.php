<?php

namespace App\Entity;

use App\Repository\TypeProblemeRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $violation_code;

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
}
