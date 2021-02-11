<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Messages\ContactMessage;
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
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
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

}