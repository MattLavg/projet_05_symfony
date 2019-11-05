<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatformRepository")
 */
class Platform
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReleaseDate", mappedBy="platform")
     */
    private $releaseDates;

    public function __construct()
    {
        $this->releaseDates = new ArrayCollection();
    }

    // public function __toString()
    // {
    //     return $this->name;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ReleaseDate[]
     */
    public function getReleaseDates(): Collection
    {
        return $this->releaseDates;
    }

    public function addReleaseDate(ReleaseDate $releaseDate): self
    {
        if (!$this->releaseDates->contains($releaseDate)) {
            $this->releaseDates[] = $releaseDate;
            $releaseDate->setPlatform($this);
        }

        return $this;
    }

    public function removeReleaseDate(ReleaseDate $releaseDate): self
    {
        if ($this->releaseDates->contains($releaseDate)) {
            $this->releaseDates->removeElement($releaseDate);
            // set the owning side to null (unless already changed)
            if ($releaseDate->getPlatform() === $this) {
                $releaseDate->setPlatform(null);
            }
        }

        return $this;
    }
}
