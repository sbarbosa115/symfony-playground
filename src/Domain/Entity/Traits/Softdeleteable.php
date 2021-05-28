<?php

declare(strict_types=1);

namespace App\Domain\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait Softdeleteable
{
    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private ?DateTime $deletedAt = null;


    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}