<?php

declare(strict_types=1);

namespace App\Entity;

use App\DTO\RoomDTO;
use App\Repository\RoomRepository;
use App\Util\SlugUtil;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $image;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $available = false;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="room")
     * @OrderBy({"createdAt" = "DESC"})
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $peopleCount;

    /**
     * @ORM\Column(type="integer")
     */
    private int $timeCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $slug;

    public function __construct(string $name, string $image, string $description, string $peopleCount, int $timeCount)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->peopleCount = $peopleCount;
        $this->timeCount = $timeCount;
        $this->comments = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getRoom(): RoomDTO
    {
        $roomDTO = new RoomDTO(
            $this->id,
            $this->name,
            $this->image,
        );
        $roomDTO->setDescription($this->description);
        $roomDTO->setPeopleCount($this->peopleCount);
        $roomDTO->setTimeCount($this->timeCount);
        $roomDTO->setComments($this->comments);
        $roomDTO->setSlug($this->slug);

        return $roomDTO;
    }

    public function makeAvailable(): void
    {
        $this->createSlug();
        $this->available = true;
    }

    public function makeNotAvailable(): void
    {
        $this->available = false;
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
            $comment->setRoom($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getRoom() === $this) {
                $comment->setRoom(null);
            }
        }

        return $this;
    }

    public function addName(string $name): void
    {
        $this->name = $name;
    }

    public function addImage(string $image): void
    {
        $this->image = $image;
    }

    public function addDescription(string $description): void
    {
        $this->description = $description;
    }

    public function addPeopleCount(string $peopleCount): void
    {
        $this->peopleCount = $peopleCount;
    }

    public function addTimeCount(int $timeCount): void
    {
        $this->timeCount = $timeCount;
    }

    public function getPeopleCount(): ?string
    {
        return $this->peopleCount;
    }

    public function getTimeCount(): ?int
    {
        return $this->timeCount;
    }

    private function createSlug(): void
    {
        $this->slug = SlugUtil::generate($this->name);
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
