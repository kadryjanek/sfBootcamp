<?php

namespace Shop\CartBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Common\Collections\ArrayCollection;
use Shop\ProductBundle\Entity\Product;

class Cart
{
    protected $session;
    private $products;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->products = $this->session->get('cart', new ArrayCollection());
    }
    
    public function add(Product $product, $count=1)
    {
        if ($this->products->containsKey($product->getId())) {
            $this->products[$product->getId()] += $count;
        } else {
            $this->products->set($product->getId(), $count);
        }
        
        $this->session->set('cart', $this->products);
    }
    
    public function remove(Product $product)
    {
        $this->products->remove($product->getId());
        
        $this->session->set('cart', $this->products);
    }
    
    /**
     * 1) Do utworzonej usługi dodać kolejny argument - usługę Doctrine
     * 2) Zwrócić produkty w koszyku, nie jako tablicę Id, ale jako obiekty Product
     * pobrane z bazy danych
     * 
     * array[] = array[
     *  'product' => Product,
     *  'count' => $count
     * ]
     * 
     */
    public function getProducts()
    {
        return $this->products;
    }
}