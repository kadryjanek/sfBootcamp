<?php

namespace Shop\ProductBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('products', array(
            'label' => 'Produkty',
            'route' => 'index',
        ));

        $menu->addChild('category', [
                'label' => 'Kategorie',
                'uri' => '#'
             ])
            ->setAttribute('class', 'dropdown')
            ->setLinkAttribute('class', 'dropdown-toggle')
            ->setLinkAttribute('data-toggle', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');

        $em = $this->container->get('doctrine.orm.entity_manager');
        $categories = $em->getRepository('ShopProductBundle:Category')->findAll();

        if ($categories) {
            foreach ($categories as $category) {
                $menu['category']->addChild('cat'.$category->getId(), array(
                    'label' => $category->getName(),
                    'route' => 'show_category',
                    'routeParameters' => array('id' => $category->getId()),
                ));
            }
        }

        $menu->addChild('cart', array(
            'label' => 'Koszyk',
            'route' => 'cart',
        ));

        $menu->addChild('contact', array(
            'label' => 'Kontakt',
            'route' => 'contact',
        ));

        return $menu;
    }
}
