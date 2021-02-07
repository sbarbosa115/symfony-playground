<?php

declare(strict_types=1);

namespace App\Domain\Contact\Aggregate;

class Contact
{

    public function __construct(
        string $email,
        string $message,
        string $subject
    ) {
        $this->email = $email;
        $this->message = $message;
        $this->subject = $subject;
    }

}