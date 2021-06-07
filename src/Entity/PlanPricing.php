<?php

namespace App\Entity;

use App\Repository\PlanPricingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanPricingRepository::class)
 */
class PlanPricing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $ram;

    /**
     * @ORM\Column(type="integer")
     */
    private $storage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $backup;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(int $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStorage(): ?int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getBackup(): ?bool
    {
        return $this->backup;
    }

    public function setBackup(bool $backup): self
    {
        $this->backup = $backup;

        return $this;
    }
}
