<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\Column(type:"uuid", unique:true)]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: School::class)]
    private $schools;

    public function __construct()
    {
        $this->id = $this->createUuid();
        $this->schools = new ArrayCollection();
    }

    /**
     * @return UuidV4
     */
    public function getId(): UuidV4
    {
        return $this->id;
    }

    private function createUuid(): UuidV4
    {
        return Uuid::v4();
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
     * @return Collection<int, School>
     */
    public function getSchools(): Collection
    {
        return $this->schools;
    }

    public function addSchool(School $school): self
    {
        if (!$this->schools->contains($school)) {
            $this->schools[] = $school;
            $school->setCountry($this);
        }

        return $this;
    }

    public function removeSchool(School $school): self
    {
        if ($this->schools->removeElement($school)) {
            // set the owning side to null (unless already changed)
            if ($school->getCountry() === $this) {
                $school->setCountry(null);
            }
        }

        return $this;
    }
}
