<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\CustomUniqueId;
use App\Domain\Entity\Traits\Softdeleteable;
use App\Domain\Entity\Traits\TimeStamps;
use App\Domain\Repository\TransactionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    use CustomUniqueId;
    use Softdeleteable;
    use TimeStamps;

    /**
     * @ORM\Column(type="integer")
     */
    private int $successfully;

    /**
     * @ORM\Column(type="integer")
     */
    private int $failed;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->failed = 0;
        $this->successfully = 0;
    }

    public function getSuccessfully(): ?int
    {
        return $this->successfully;
    }

    public function addSuccessfully(): self
    {
        ++$this->successfully;

        return $this;
    }

    public function getFailed(): ?int
    {
        return $this->failed;
    }

    public function addFailed(): self
    {
        ++$this->failed;

        return $this;
    }
}
