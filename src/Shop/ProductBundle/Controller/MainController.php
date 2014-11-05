<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\Common\Collections\ArrayCollection;
use Shop\ProductBundle\Form\ContactFormType;

class MainController extends Controller
{
    
	
	public function indexAction()
    {
        $products = $this->getProducts();
                
        return $this->render('ShopProductBundle:Main:index.html.twig', array(
                'products' => $products,        		
        	));   
    }

    public function addToCartAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('ShopProductBundle:Product')
            ->find($id);
    	
    	if (!$product) {
    	    throw $this->createNotFoundException('Produkt nie istnieje');
    	}
    	
    	$this->get('shop_cart')
    	   ->add($product);
    	//$cart->add($product, 1);
    	
    	return $this->redirect($this->generateUrl('cart'));
    }
    
    /**
     * @Template()
     */
    public function cartAction()
    {
    	$products = $this->get('shop_cart')
    	   ->getProducts();
    	
    	$products = $this->getDoctrine()
    	   ->getRepository('ShopProductBundle:Product')
    	   ->findBy([
                'id' => $products->getKeys()
    	   ]);
    	
    	return ['products' => $products];
    }
    
    private function getProducts()
    {
    	return $this->getDoctrine()
            ->getRepository('ShopProductBundle:Product')
            ->findAll();
    }
    
    public function showProductInCategoryAction($id)
    {
        $products = $this->getDoctrine()
                ->getRepository('ShopProductBundle:Product')
                ->findBy([
                    'category' => $id,
                ]);
        
        return $this->render('ShopProductBundle:Main:product_list.html.twig', array(
                'products' => $products,        		
        	));  
    }
    
    public function contactAction()
    {
        $request = $this->getRequest();
        
        $form = $this->createForm(new ContactFormType());
        
        return $this->render('ShopProductBundle:Main:contact.html.twig', [
           'form' => $form->createView(), 
        ]);
    }

}
