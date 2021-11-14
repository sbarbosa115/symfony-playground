<?php

declare(strict_types=1);

namespace App\Domain\Contact\Model;

class ContactNotification
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

}