<?php

declare(strict_types=1);

namespace App\Application\MessageHandler;

use App\Application\Messages\ContactMessage;
use App\Domain\Entity\Transaction;
use App\Domain\Entity\User;
use App\Domain\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ContactHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $manager;

    private TransactionRepository $transactionRepo;

    public function __construct(
        EntityManagerInterface $manager,
        TransactionRepository $transactionRepo
    ) {
        $this->manager = $manager;
        $this->transactionRepo = $transactionRepo;
    }

    public function __invoke(ContactMessage $message): void
    {
        // HERE STORE IT INTO THE DATABASE LOGIC
        $payload = json_decode($message->getContact(), true, 512, JSON_THROW_ON_ERROR);
        $user = (new User())->setEmail($payload['email']);

        $transaction = $this->transactionRepo->find($message->getTransaction());
        if ($transaction instanceof Transaction) {
            $transaction->addFailed();
            $this->manager->persist($transaction);
        }

        $this->manager->persist($user);
        $this->manager->flush();

    }

}