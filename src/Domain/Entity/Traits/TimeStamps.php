<?php

declare(strict_types=1);

namespace App\Domain\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TimeStamps
{
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private ?DateTime $createdAt = null;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private ?DateTime $updatedAt = null;

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}