<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeparturePublicationRepository")
 */
class DeparturePublication
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departureCity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrivalCity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureDatetime;

    /**
     * @ORM\Column(type="integer")
     */
    private $remainingSeats;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="departurePublications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartureCity(): ?string
    {
        return $this->departureCity;
    }

    public function setDepartureCity(string $departureCity): self
    {
        $this->departureCity = $departureCity;

        return $this;
    }

    public function getArrivalCity(): ?string
    {
        return $this->arrivalCity;
    }

    public function setArrivalCity(string $arrivalCity): self
    {
        $this->arrivalCity = $arrivalCity;

        return $this;
    }

    public function getDepartureDatetime(): ?\DateTimeInterface
    {
        return $this->departureDatetime;
    }

    public function setDepartureDatetime(\DateTimeInterface $departureDatetime): self
    {
        $this->departureDatetime = $departureDatetime;

        return $this;
    }

    public function getRemainingSeats(): ?int
    {
        return $this->remainingSeats;
    }

    public function setRemainingSeats(int $remainingSeats): self
    {
        $this->remainingSeats = $remainingSeats;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
