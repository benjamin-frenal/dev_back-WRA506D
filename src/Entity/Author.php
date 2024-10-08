<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['author:read']]
)]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'fullName' => 'partial'])]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['movie:read', 'category:read', 'author:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['movie:read', 'category:read', 'author:read'])]
    #[Assert\Length(min: 2, max: 50, maxMessage: 'Ecrire votre message en 50 caractères ou moins.')]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    #[Groups(['movie:read', 'category:read','author:read'])]
    #[Assert\Length(min: 2, max: 50, maxMessage: 'Ecrire votre message en 50 caractères ou moins.')]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['author:read'])]
    private ?string $fullName = null;
  
    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors')]
    #[Groups(['author:read'])]
    private Collection $movies;

    #[ORM\ManyToOne(inversedBy: 'actor')]
    #[Groups(['author:read'])]
    private ?Nationalite $nationalite = null;
  
    #[Groups(['author:read'])]
    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(name: "image_id", referencedColumnName: "id")]
    private ?MediaObject $image = null;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;
        $this->updateFullName();

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;
        $this->updateFullName();

        return $this;
    }

    private function updateFullName(): void
    {
        $this->fullName = trim($this->firstName . ' ' . $this->lastName);
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->addActor($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeActor($this);
        }

        return $this;
    }

    public function getNationalite(): ?Nationalite
    {
        return $this->nationalite;
    }

    public function setNationalite(?Nationalite $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    public function setImage(?MediaObject $image): static
    {
        $this->image = $image;

        return $this;
    }
}
