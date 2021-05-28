<?php

declare(strict_types=1);

namespace App\Domain\Generator;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

class UniqueGenerator extends AbstractIdGenerator
{
    public function generate(EntityManager $em, $entity): string
    {
        return uniqid('', false);
    }

}