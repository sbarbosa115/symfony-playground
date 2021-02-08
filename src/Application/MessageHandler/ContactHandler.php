<?php
declare(strict_types=1);

namespace App\Application\MessageHandler;

use App\Application\Messages\ContactMessage;
use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ContactHandler implements MessageHandlerInterface
{

    public EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function __invoke(ContactMessage $message): void
    {
        // HERE STORE IT INTO THE DATABASE LOGIC
        $payload = json_decode($message->getContact(), true, 512, JSON_THROW_ON_ERROR);
        $user = (new User())
            ->setEmail($payload['email']);

        $this->manager->persist($user);
        $this->manager->flush();

    }

}