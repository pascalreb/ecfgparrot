<?php

namespace App\Entity;

use App\Repository\HourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourRepository::class)]
class Hour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $openingTime1 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closingTime1 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $openingTime2 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closingTime2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningTime1(): ?\DateTimeInterface
    {
        return $this->openingTime1;
    }

    public function setOpeningTime1(\DateTimeInterface $openingTime1): static
    {
        $this->openingTime1 = $openingTime1;

        return $this;
    }

    public function getClosingTime1(): ?\DateTimeInterface
    {
        return $this->closingTime1;
    }

    public function setClosingTime1(\DateTimeInterface $closingTime1): static
    {
        $this->closingTime1 = $closingTime1;

        return $this;
    }

    public function getOpeningTime2(): ?\DateTimeInterface
    {
        return $this->openingTime2;
    }

    public function setOpeningTime2(\DateTimeInterface $openingTime2): static
    {
        $this->openingTime2 = $openingTime2;

        return $this;
    }

    public function getClosingTime2(): ?\DateTimeInterface
    {
        return $this->closingTime2;
    }

    public function setClosingTime2(\DateTimeInterface $closingTime2): static
    {
        $this->closingTime2 = $closingTime2;

        return $this;
    }
}
