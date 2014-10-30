<?php

namespace Shop\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ShopCartBundle:Default:index.html.twig', array('name' => $name));
    }
}
