<?php

declare(strict_types=1);

namespace App\Domain\DataFixtures;

use App\Domain\Entity\File;
use App\Domain\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $product = new Product();
        $product->setName('Product Name');
        $product->setDescription('SOME DESCRIPTION');
        $product->setPrice(mt_rand(10, 100));
        $manager->persist($product);

        for ($i = 0; $i < 200000; $i++) {
            $file = new File();
            $file->setName('file '.$i);
            $file->setProduct($product);
            $file->setType(1);
            $file->setUrl('https://example.com');
            $product->addFile($file);

            $manager->persist($file);
        }

        $manager->flush();
    }
}
