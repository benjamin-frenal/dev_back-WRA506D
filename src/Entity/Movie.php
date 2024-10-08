<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['movie:read']]
)]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'title' => 'partial'])]
class Movie
{
    #[ORM\Id]
    #[Groups(['author:read','category:read','movie:read'])]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[Groups(['movie:read', 'category:read'])]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'movies')]
    #[Groups(['movie:read', 'category:read'])]
    private Collection $actors;

    #[ORM\Column(length: 255)]
    #[Groups(['author:read', 'category:read', 'movie:read'])]
    #[Assert\Length(min: 2, max: 255, maxMessage: 'Ecrire votre message en 255 caractères ou moins.')]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['movie:read', 'category:read'])]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'category:read'])]
    #[Assert\NotBlank]
    #[ApiFilter(RangeFilter::class)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['author:read','category:read','movie:read'])]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[Groups(['author:read','category:read','movie:read'])]
    #[Assert\NotBlank]
    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(name: "miniature", referencedColumnName: "id")]
    private ?MediaObject $miniature = null;

    #[Groups(['movie:read'])]
    #[Assert\NotBlank]
    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(name: "background", referencedColumnName: "id")]
    private ?MediaObject $background = null;

    #[Groups(['movie:read'])]
    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(name: "logo", referencedColumnName: "id")]
    private ?MediaObject $logo = null;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Author $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
        }

        return $this;
    }

    public function removeActor(Author $actor): static
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMiniature(): ?MediaObject
    {
        return $this->miniature;
    }

    public function setMiniature(?MediaObject $miniature): static
    {
        $this->miniature = $miniature;

        return $this;
    }

    public function getBackground(): ?MediaObject
    {
        return $this->background;
    }

    public function setBackground(?MediaObject $background): static
    {
        $this->background = $background;

        return $this;
    }

    public function getLogo(): ?MediaObject
    {
        return $this->logo;
    }

    public function setLogo(?MediaObject $logo): static
    {
        $this->logo = $logo;

        return $this;
    }
}
