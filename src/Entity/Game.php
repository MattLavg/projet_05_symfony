<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=2, max=50, minMessage="Votre titre est trop court.")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * * @Assert\Length(min=10)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $coverExtension;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $updatedByMember;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $toValidate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Developer", mappedBy="games")
     */
    private $developers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="game", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", mappedBy="game")
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Mode", mappedBy="game")
     */
    private $modes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReleaseDate", mappedBy="game", orphanRemoval=true, cascade={"persist"})
     */
    private $releaseDates;

    public function __construct()
    {
        $this->developers = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->modes = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCoverExtension(): ?string
    {
        return $this->coverExtension;
    }

    public function setCoverExtension(string $coverExtension): self
    {
        $this->coverExtension = $coverExtension;

        return $this;
    }

    public function getUpdatedByMember(): ?bool
    {
        return $this->updatedByMember;
    }

    public function setUpdatedByMember(?bool $updatedByMember): self
    {
        $this->updatedByMember = $updatedByMember;

        return $this;
    }

    public function getToValidate(): ?bool
    {
        return $this->toValidate;
    }

    public function setToValidate(?bool $toValidate): self
    {
        $this->toValidate = $toValidate;

        return $this;
    }

    /**
     * @return Collection|Developer[]
     */
    public function getDevelopers(): Collection
    {
        return $this->developers;
    }

    public function addDeveloper(Developer $developer): self
    {
        if (!$this->developers->contains($developer)) {
            $this->developers[] = $developer;
            $developer->addGame($this);
        }

        return $this;
    }

    public function removeDeveloper(Developer $developer): self
    {
        if ($this->developers->contains($developer)) {
            $this->developers->removeElement($developer);
            $developer->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setGame($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getGame() === $this) {
                $comment->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
            $genre->addGame($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
            $genre->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Mode[]
     */
    public function getModes(): Collection
    {
        return $this->modes;
    }

    public function addMode(Mode $mode): self
    {
        if (!$this->modes->contains($mode)) {
            $this->modes[] = $mode;
            $mode->addGame($this);
        }

        return $this;
    }

    public function removeMode(Mode $mode): self
    {
        if ($this->modes->contains($mode)) {
            $this->modes->removeElement($mode);
            $mode->removeGame($this);
        }

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
            $releaseDate->setGame($this);
        }

        return $this;
    }

    public function removeReleaseDate(ReleaseDate $releaseDate): self
    {
        if ($this->releaseDates->contains($releaseDate)) {
            $this->releaseDates->removeElement($releaseDate);
            // set the owning side to null (unless already changed)
            if ($releaseDate->getGame() === $this) {
                $releaseDate->setGame(null);
            }
        }

        return $this;
    }
}
