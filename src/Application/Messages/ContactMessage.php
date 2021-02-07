<?php

declare(strict_types=1);

namespace App\Application\Messages;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

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