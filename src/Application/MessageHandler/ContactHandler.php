<?php
declare(strict_types=1);

namespace App\Application\MessageHandler;


use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ContactHandler implements MessageHandlerInterface
{

    public function __invoke()
    {
        // HERE STORE IT INTO THE DATABASE LOGIC
    }

}