<?php

declare(strict_types=1);

namespace App\Tests\Functional\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{

    public function testCreate(): void
    {
        self::assertEquals(1, 1);
    }

}