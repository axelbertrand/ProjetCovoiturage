<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Cette adresse courriel est déjà utilisée"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Veuillez entrer une adresse courriel")
     * @Assert\Email(message="Veuillez entrer une adresse courriel valide")
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $maximumOfSeats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeparturePublication", mappedBy="user", orphanRemoval=true)
     */
    private $departurePublications;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $canSmoke;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $canAccessDriverPhoneNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $canAccessDriverEmail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $canPutSuitcase;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="user")
     */
    private $reservations;

    public function __construct()
    {
        $this->departurePublications = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getMaximumOfSeats(): ?int
    {
        return $this->maximumOfSeats;
    }

    public function setMaximumOfSeats(int $maximumOfSeats): self
    {
        $this->maximumOfSeats = $maximumOfSeats;

        return $this;
    }

    /**
     * @return Collection|DeparturePublication[]
     */
    public function getDeparturePublications(): Collection
    {
        return $this->departurePublications;
    }

    public function addDeparturePublication(DeparturePublication $departurePublication): self
    {
        if (!$this->departurePublications->contains($departurePublication)) {
            $this->departurePublications[] = $departurePublication;
            $departurePublication->setUser($this);
        }

        return $this;
    }

    public function removeDeparturePublication(DeparturePublication $departurePublication): self
    {
        if ($this->departurePublications->contains($departurePublication)) {
            $this->departurePublications->removeElement($departurePublication);
            // set the owning side to null (unless already changed)
            if ($departurePublication->getUser() === $this) {
                $departurePublication->setUser(null);
            }
        }

        return $this;
    }

    public function getCanSmoke(): ?bool
    {
        return $this->canSmoke;
    }

    public function setCanSmoke(?bool $canSmoke): self
    {
        $this->canSmoke = $canSmoke;

        return $this;
    }

    public function getCanAccessDriverPhoneNumber(): ?bool
    {
        return $this->canAccessDriverPhoneNumber;
    }

    public function setCanAccessDriverPhoneNumber(?bool $canAccessDriverPhoneNumber): self
    {
        $this->canAccessDriverPhoneNumber = $canAccessDriverPhoneNumber;

        return $this;
    }

    public function getCanAccessDriverEmail(): ?bool
    {
        return $this->canAccessDriverEmail;
    }

    public function setCanAccessDriverEmail(?bool $canAccessDriverEmail): self
    {
        $this->canAccessDriverEmail = $canAccessDriverEmail;

        return $this;
    }

    public function getCanPutSuitcase(): ?bool
    {
        return $this->canPutSuitcase;
    }

    public function setCanPutSuitcase(?bool $canPutSuitcase): self
    {
        $this->canPutSuitcase = $canPutSuitcase;

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
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }
}
