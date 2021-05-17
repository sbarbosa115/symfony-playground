<?php

namespace App\Domain\Entity;

use App\Domain\Repository\TransactionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
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
