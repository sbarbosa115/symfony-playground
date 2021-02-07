<?php

declare(strict_types=1);

namespace App\Application\Message;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NotificationHandler implements MessageHandlerInterface
{
    public function __invoke(NotificationHandler $message)
    {
        // ... do some work - like sending an SMS message!
    }
}