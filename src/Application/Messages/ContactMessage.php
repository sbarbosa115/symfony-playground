<?php

declare(strict_types=1);

namespace App\Application\Messages;

use App\Domain\Entity\Transaction;

class ContactMessage
{
    private string $concat;

    private ?int $transaction;

    public function __construct(string $contact, int $transaction = null)
    {
        $this->concat = $contact;
        $this->transaction = $transaction;
    }

    public function getContact(): string
    {
        return $this->concat;
    }

    public function getTransaction(): ?int
    {
        return $this->transaction;
    }
}