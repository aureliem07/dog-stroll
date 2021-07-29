<?php

namespace App\Entity;

use App\Repository\TownRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TownRepository::class)
 */
class Town
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $simpleName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realName;

    /**
     * @ORM\Column(type="integer")
     */
    private $postalCode;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="town")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Stroll::class, mappedBy="town")
     */
    private $strolls;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->strolls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartment(): ?int
    {
        return $this->department;
    }

    public function setDepartment(int $department): self
    {
        $this->department = $department;

        return $this;
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

    public function getSimpleName(): ?string
    {
        return $this->simpleName;
    }

    public function setSimpleName(string $simpleName): self
    {
        $this->simpleName = $simpleName;

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setTown($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTown() === $this) {
                $user->setTown(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stroll[]
     */
    public function getStrolls(): Collection
    {
        return $this->strolls;
    }

    public function addStroll(Stroll $stroll): self
    {
        if (!$this->strolls->contains($stroll)) {
            $this->strolls[] = $stroll;
            $stroll->setTown($this);
        }

        return $this;
    }

    public function removeStroll(Stroll $stroll): self
    {
        if ($this->strolls->removeElement($stroll)) {
            // set the owning side to null (unless already changed)
            if ($stroll->getTown() === $this) {
                $stroll->setTown(null);
            }
        }

        return $this;
    }
}
