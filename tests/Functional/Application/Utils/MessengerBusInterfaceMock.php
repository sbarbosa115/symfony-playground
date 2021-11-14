<?php
declare(strict_types=1);

namespace App\Tests\Functional\Application\Utils;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerBusInterfaceMock implements MessageBusInterface
{
    public int $spyCount = 0;

    public function dispatch($message, array $stamps = []): Envelope
    {
        $this->spyCount++;
        return new Envelope($message);
    }
}