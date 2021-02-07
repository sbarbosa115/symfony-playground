<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Domain\Contact\Model\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

    /**
     * @Route("/", name="contact.create")
     */
    public function create(MessageBusInterface $bus, Request $request): Response
    {
        $payload = $request->request->all();
        $bus->dispatch(new ContactNotification('TEMP'));

        return new Response('test');
    }

}