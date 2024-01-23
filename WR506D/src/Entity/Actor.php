<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['lastname','firstname' => 'partial', 'movies.title' => 'partial'])]
#[ApiFilter(DateFilter::class, properties: ['dob'])]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    #[Assert\Type('string')]
    private ?string $firstname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;



    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors', cascade : ['persist', 'remove'], fetch: 'EAGER')]
    private Collection $movies;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Choice(['Oscars', 'Grammies', 'Festival de Cannes'])]
    private ?string $reward = null;

    #[ORM\Column(length: 255)]
    private ?string $nationality = null;

    #[ORM\ManyToOne(inversedBy: 'actors')]
    private ?MediaObject $MediaObject = null;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    public function getReward(): ?string
    {
        return $this->reward;
    }

    public function setReward(string $reward): static
    {
        $this->reward = $reward;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getMediaObject(): ?MediaObject
    {
        return $this->MediaObject;
    }

    public function setMediaObject(?MediaObject $MediaObject): static
    {
        $this->MediaObject = $MediaObject;

        return $this;
    }
}
