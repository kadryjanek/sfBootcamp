<?php

namespace Shop\ProductBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testAddtocart()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add-to-cart/{id}');
    }

}
