<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\CustomUniqueId;
use App\Domain\Entity\Traits\Softdeleteable;
use App\Domain\Entity\Traits\TimeStamps;
use App\Domain\Repository\TagRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    use CustomUniqueId;
    use Softdeleteable;
    use TimeStamps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="tags", cascade={"ALL"})
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();

        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
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
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }
}
