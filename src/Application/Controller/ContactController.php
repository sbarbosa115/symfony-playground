<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Messages\ContactMessage;
use App\Domain\Entity\Transaction;
use App\Domain\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contact", name="contact."))
 */
class ContactController extends AbstractController
{

    /**
     *
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(TransactionRepository $transactionRepo): Response
    {
        $transaction = $transactionRepo->find('1');
        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(MessageBusInterface $bus, Request $request): Response
    {
        $bus->dispatch(new ContactMessage($request->getContent()));

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/create-batch", name="create-batch", methods={"POST"})
     */
    public function createBatch(
        MessageBusInterface $bus,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $contents = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $transaction = new Transaction();
        $entityManager->persist($transaction);
        $entityManager->flush();

        foreach ($contents as $content) {
            $bus->dispatch(new ContactMessage(json_encode($content, JSON_THROW_ON_ERROR), $transaction->getId()));
        }

        return new JsonResponse(['status' => 'ok']);
    }

}