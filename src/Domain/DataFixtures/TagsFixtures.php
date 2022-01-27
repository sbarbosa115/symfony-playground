<?php

namespace App\Domain\DataFixtures;

use App\Domain\Entity\Product;
use App\Domain\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = (new Product())
            ->setDescription('Description product 1')
            ->setName('Product 1 Name')
            ->setPrice(99.00);

        for ($i = 0; $i < 200000; $i++) {

            $tag = (new Tag())
                ->setName(sprintf('Tag Product %s', $i))
                ->setDescription(sprintf('Description Product %s', $i));
            $tag->addProduct($product);

            $manager->persist($tag);
        }

        $manager->persist($product);
        $manager->flush();
    }
}
