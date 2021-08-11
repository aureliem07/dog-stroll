<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StrollRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=StrollRepository::class)
 */
class Stroll
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $startingPoint;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="strollSubscriptions")
     */
    private $subscribers;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $town;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false, name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    public function __construct()
    {
        $this->subscribers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getStartingPoint(): ?string
    {
        return $this->startingPoint;
    }

    public function setStartingPoint(string $startingPoint): self
    {
        $this->startingPoint = $startingPoint;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    public function addSubscriber(User $user): self
    {
        if (!$this->subscribers->contains($user)) {
            $this->subscribers[] = $user;
            $user->addStroll($this);
        }

        return $this;
    }

    public function removeSubscriber(User $user): self
    {
        if ($this->subscribers->removeElement($user)) {
            $user->removeStrollSubscription($this);
        }

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
    
        $this->createdBy = $createdBy;

        return $this;
    }

}
