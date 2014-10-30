<?php

namespace Shop\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Shop\ProductBundle\Entity\Product;

class LoadProductsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }
    
    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setName('HDD 1T Seagate');
        $product1->setDescription('Jakiś opis dysku');
        $product1->setPrice(200);
        $product1->setAmount(10);
        $product1->setCategory($manager->merge($this->getReference('category1')));
        $manager->persist($product1);
        
        $product2 = new Product();
        $product2->setName('Klawiatura Logitech');
        $product2->setDescription('Jakiś opis klawiatury');
        $product2->setPrice(50);
        $product2->setAmount(10);
        $product2->setCategory($manager->merge($this->getReference('category2')));
        $manager->persist($product2);
        
        $product3 = new Product();
        $product3->setName('Drukarka HP');
        $product3->setDescription('Jakiś opis drukarki');
        $product3->setPrice(250);
        $product3->setAmount(10);
        $product3->setCategory($manager->merge($this->getReference('category3')));
        $manager->persist($product3);
        
        $manager->flush();
    }
}