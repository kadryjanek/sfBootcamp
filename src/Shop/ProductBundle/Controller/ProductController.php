<?php

namespace Shop\ProductBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\ProductBundle\Form\ProductType;
use Shop\CoreBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('ShopProductBundle:Product')
            ->findAll();
        
        return ['products' => $products];    
    }

    /**
     * @Template
     */
    public function newAction()
    {
        $request = $this->getRequest();
        
        $form = $this->createForm(new ProductType(), null, []);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $product = $form->getData();
            
            $this->persist($product);
            
            /*
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            */
            
            $this->get('session')->getFlashBag()
                ->add('notice', "Produkt został pomyślnie dodany");
            
            return $this->redirect($this->generateUrl('product_list'));
            
        }
        
        return ['form'  => $form->createView()];
    }

    public function editAction($id)
    {
        $request = $this->getRequest();
        $product = $this->findOr404('ShopProductBundle:Product', $id);
        
        /*
        $product = $this->getDoctrine()
            ->getRepository('ShopProductBundle:Product')
            ->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException(sprintf("Product #%d not found!", $id));
        }
        */
        
        $form = $this->createForm(new ProductType(), $product, []);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $this->getDoctrine()->getManager()
                ->flush();
            
            $this->get('session')->getFlashBag()
                ->add('notice', "Produkt został pomyślnie zaktualizowany");
            
            return $this->redirect($this->generateUrl('product_list'));
        }
        
        return $this->render('ShopProductBundle:Product:edit.html.twig', array(
            'form'  => $form->createView()  
        ));
    }

    public function deleteAction($id)
    {
        $product = $this->findOr404('ShopProductBundle:Product', $id);
        $this->remove($product);
        $this->addFlash('notice', 'Produkt został pomyślnie usunięty.');
        
        /*
        $product = $this->getDoctrine()
            ->getRepository('ShopProductBundle:Product')
            ->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException(sprintf("Product #%d not found!", $id));
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        
        $this->get('session')->getFlashBag()
            ->add('notice', 'Produkt został pomyślnie usunięty.');
        */
        
        return $this->redirect($this->generateUrl('product_list'));
    }

}
