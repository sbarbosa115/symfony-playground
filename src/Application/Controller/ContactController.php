<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Messages\ContactMessage;
use App\Domain\Entity\File;
use App\Domain\Entity\Product;
use App\Domain\Entity\Tag;
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
    public function index(TransactionRepository $transactionRepo, MessageBusInterface $bus,): Response
    {
        $transaction = $transactionRepo->find('1');

        $bus->dispatch(new ContactMessage('TRABAJO_SUCIO'));

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
            $bus->dispatch(new ContactMessage(json_encode($content, JSON_THROW_ON_ERROR)));
        }

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/huge-relationships-no-contains", name="huge-relationships-no", methods={"GET"})
     */
    public function hugeRelationshipsNoContains(
        EntityManagerInterface $entityManager
    ): Response {
        $product = $entityManager->find(Product::class, ['id' => '61f2160e0c9c2']);

        $file = new File();
        $file->setUrl('https://exmaple.com');
        $file->setType(2);
        $file->setName('some');

        $product->addFile($file);

        $tag = new Tag();
        $tag->setName('Tag Product New');
        $tag->setDescription('Description Product New');

        $product->addTag($tag);

        $entityManager->persist($product);
        $entityManager->persist($tag);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/huge-relationships-contains", name="huge-relationships-contains", methods={"GET"})
     */
    public function hugeRelationshipsContains(
        EntityManagerInterface $entityManager
    ): Response {

        $product = $entityManager->find(Product::class, ['id' => '61f2068edaefa']);
        $file = $entityManager->find(File::class, ['id' => '61f206cec4f21']);

        $product->addFile($file);

        $entityManager->persist($product);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok']);
    }

}
