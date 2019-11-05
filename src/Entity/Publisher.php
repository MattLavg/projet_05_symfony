<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PublisherRepository")
 */
class Publisher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReleaseDate", mappedBy="publisher")
     */
    private $releaseDates;

    public function __construct()
    {
        $this->releaseDates = new ArrayCollection();
    }

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
            $releaseDate->setPublisher($this);
        }

        return $this;
    }

    public function removeReleaseDate(ReleaseDate $releaseDate): self
    {
        if ($this->releaseDates->contains($releaseDate)) {
            $this->releaseDates->removeElement($releaseDate);
            // set the owning side to null (unless already changed)
            if ($releaseDate->getPublisher() === $this) {
                $releaseDate->setPublisher(null);
            }
        }

        return $this;
    }
}
