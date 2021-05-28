<?php

declare(strict_types=1);

namespace App\Domain\Entity\Traits;

use App\Domain\Generator\UniqueGenerator;
use Doctrine\ORM\Mapping as ORM;

trait CustomUniqueId
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=14)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UniqueGenerator::class)
     */
    private string $id;

    public function getId(): string
    {
        return $this->id;
    }
}