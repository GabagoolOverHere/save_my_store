<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToOne(targetEntity=PatronPrestataire::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $patron_prestataire;

    /**
     * @ORM\OneToOne(targetEntity=PatronRestaurant::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $patron_restaurant;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPatronPrestataireId(): ?int
    {
        return $this->patron_prestataire_id;
    }

    public function setPatronPrestataireId(?int $patron_prestataire_id): self
    {
        $this->patron_prestataire_id = $patron_prestataire_id;

        return $this;
    }

    public function getPatronRestaurantId(): ?int
    {
        return $this->patron_restaurant_id;
    }

    public function setPatronRestaurantId(?int $patron_restaurant_id): self
    {
        $this->patron_restaurant_id = $patron_restaurant_id;

        return $this;
    }

    public function getPatronPrestaId(): ?PatronPrestataire
    {
        return $this->patron_presta_id;
    }

    public function setPatronPrestaId(PatronPrestataire $patron_presta_id): self
    {
        // set the owning side of the relation if necessary
        if ($patron_presta_id->getAdminId() !== $this) {
            $patron_presta_id->setAdminId($this);
        }

        $this->patron_presta_id = $patron_presta_id;

        return $this;
    }

    public function getPatronRestauId(): ?PatronRestaurant
    {
        return $this->patron_restau_id;
    }

    public function setPatronRestauId(?PatronRestaurant $patron_restau_id): self
    {
        // unset the owning side of the relation if necessary
        if ($patron_restau_id === null && $this->patron_restau_id !== null) {
            $this->patron_restau_id->setAdminId(null);
        }

        // set the owning side of the relation if necessary
        if ($patron_restau_id !== null && $patron_restau_id->getAdminId() !== $this) {
            $patron_restau_id->setAdminId($this);
        }

        $this->patron_restau_id = $patron_restau_id;

        return $this;
    }

    public function getPatronPrestataire(): ?PatronPrestataire
    {
        return $this->patron_prestataire;
    }

    public function setPatronPrestataire(?PatronPrestataire $patron_prestataire): self
    {
        $this->patron_prestataire = $patron_prestataire;

        return $this;
    }

    public function getPatronRestaurant(): ?PatronRestaurant
    {
        return $this->patron_restaurant;
    }

    public function setPatronRestaurant(?PatronRestaurant $patron_restaurant): self
    {
        $this->patron_restaurant = $patron_restaurant;

        return $this;
    }
}
