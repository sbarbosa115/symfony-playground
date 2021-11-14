<?php

namespace App\Domain\DataFixtures;

use App\Domain\Entity\Product;
use App\Domain\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = (new Product())
            ->setDescription('Description product 1')
            ->setName('Product 1 Name')
            ->setPrice(99.00);

//        $tag = (new Tag())
//            ->setName('Tag Product 1')
//            ->setDescription('Description Product 1');

//        $product->addTag($tag);
//        $tag->addProduct($product);

        $manager->persist($product);
//        $manager->persist($tag);
        $manager->flush();
    }
}
