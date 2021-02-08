<?php

declare(strict_types=1);

namespace App\Application\Messages;

class ContactMessage
{
    public string $concat;

    public function __construct(string $contact)
    {
        $this->concat = $contact;
    }

    public function getContact(): string
    {
        return $this->concat;
    }
}