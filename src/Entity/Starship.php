<?php

namespace App\Entity;

use App\Repository\StarshipPartRepository;
use App\Repository\StarshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: StarshipRepository::class)]
class Starship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(length: 255)]
    private ?string $captain = null;

    #[ORM\Column(enumType: StarshipStatusEnum::class)]
    private ?StarshipStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $arrivedAt = null;

    #[ORM\Column(unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column()]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column()]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, StarshipPart>
     */
    #[ORM\OneToMany(targetEntity: StarshipPart::class, mappedBy: 'starship', fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\OrderBy(['name' => 'ASC'])]
    private Collection $parts;

    /**
     * @var Collection<int, Droid>
     */
    #[ORM\ManyToMany(targetEntity: Droid::class, inversedBy: 'starships')]
    private Collection $droids;

    public function __construct()
    {
        $this->parts = new ArrayCollection();
        $this->droids = new ArrayCollection();
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

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getCaptain(): ?string
    {
        return $this->captain;
    }

    public function setCaptain(string $captain): static
    {
        $this->captain = $captain;

        return $this;
    }

    public function getStatus(): ?StarshipStatusEnum
    {
        return $this->status;
    }

    public function setStatus(StarshipStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getArrivedAt(): ?\DateTimeImmutable
    {
        return $this->arrivedAt;
    }

    public function setArrivedAt(\DateTimeImmutable $arrivedAt): static
    {
        $this->arrivedAt = $arrivedAt;

        return $this;
    }

    public function getStatusString(): string
    {
        return $this->status->value;
    }

    public function getStatusImageFilename(): string
    {
        return match ($this->status) {
            StarshipStatusEnum::IN_PROGRESS => 'images/status-in-progress.png',
            StarshipStatusEnum::COMPLETED => 'images/status-complete.png',
            StarshipStatusEnum::WAITING => 'images/status-waiting.png',
        };
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function checkIn(?\DateTimeImmutable $arrivedAt = null): static
    {
        $this->setArrivedAt($arrivedAt ?? new \DateTimeImmutable('now'));
        $this->setStatus(StarshipStatusEnum::WAITING);

        return $this;
    }

    /**
     * @return Collection<int, StarshipPart>
     */
    public function getParts(): Collection
    {
        return $this->parts;
    }

    // /**
    //  * @return Collection<int, StarshipPart>
    //  */
    // public function getExpensiveParts(): Collection
    //     {
    //     return $this->parts->matching(StarshipPartRepository::createExpensiveCriteria());
    // }

    public function addPart(StarshipPart $part): static
    {
        if (!$this->parts->contains($part)) {
            $this->parts->add($part);
            $part->setStarship($this);
        }

        return $this;
    }

    public function removePart(StarshipPart $part): static
    {
        if ($this->parts->removeElement($part)) {
            // set the owning side to null (unless already changed)
            if ($part->getStarship() === $this) {
                $part->setStarship(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Droid>
     */
    public function getDroids(): Collection
    {
        return $this->droids;
    }

    public function addDroid(Droid $droid): static
    {
        if (!$this->droids->contains($droid)) {
            $this->droids->add($droid);
        }

        return $this;
    }

    public function removeDroid(Droid $droid): static
    {
        $this->droids->removeElement($droid);

        return $this;
    }
}
