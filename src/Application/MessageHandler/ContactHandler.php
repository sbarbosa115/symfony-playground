<?php
declare(strict_types=1);

namespace App\Application\MessageHandler;


use App\Application\Messages\ContactMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ContactHandler implements MessageHandlerInterface
{

    public function __invoke(ContactMessage $message): void
    {
        // HERE STORE IT INTO THE DATABASE LOGIC
    }

}