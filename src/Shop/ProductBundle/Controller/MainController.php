<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\Common\Collections\ArrayCollection;
use Shop\ProductBundle\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            
            // name - $data['name']
            
            $message = \Swift_Message::newInstance()
                ->setSubject('Wiadomość z serwisu ShopApp')
                ->setFrom($data['email'])
                ->setTo('symfony.app@o2.pl')
                ->setBody(
                    $this->renderView('ShopProductBundle:Main:email.html.twig', [
                        'name' => $data['name'],
                        'message' => $data['message'],
                    ]), 
                'text/html');
            
            // jeśli to jest żądanie Ajaksowe
            if ($request->isXmlHttpRequest()) {
                
                return new JsonResponse([
                    'success'   => true,
                    'message'   => 'Formularz został pomyślnie wysłany'
                ]);
            }
            
            if ($this->get('mailer')->send($message)) {
                $this->get('session')->getFlashBag()->add('success', 'Wiadomość została wysłana');
            } else {
                $this->get('session')->getFlashBag()->add('error', 'Błąd wysyłki');
            }
            
            return $this->redirect($this->generateUrl('contact'));            
        }
        
        // jeśli to jest żądanie Ajaksowe
        if ($request->isXmlHttpRequest()) {
            
            return new JsonResponse([
                'success'   => false, 
                'message'   => 'W formularzu wystąpiły błędy opisane szczegółowo poniżej.',
                'view'      => $this->renderView('ShopProductBundle:Main:form.html.twig', [
                    'form'  => $form->createView()
                ])
            ]);
        }
        
        return $this->render('ShopProductBundle:Main:contact.html.twig', [
           'form' => $form->createView(), 
        ]);
    }

}
