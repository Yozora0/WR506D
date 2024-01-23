<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'categories')]
    private Collection $relation;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?MediaObject $MediaObject = null;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Movie $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(Movie $relation): static
    {
        $this->relation->removeElement($relation);

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
