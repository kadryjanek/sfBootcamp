<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\ProductBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/list", name="user_list")
     * @Template()
     */
    public function listAction()
    {
        return [];
    }
    
    /**
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $user = new User();
        $user->setFirstName("Robert");
        $user->setLastName("Lewandowski");
        $user->setEmail('robert@bootcamp.pl');
        $user->setNote('Some notes');

        $em = $this->getDoctrine()->getManager();
        
        $em->persist($user);
        $em->flush();
        
        return $this->redirect($this->generateUrl('user_list'));
    }
    

    /**
     * @Route("/edit/{id}", name="user_edit")
     * @Template()
     */
    public function editAction($id)
    {
        // ...
        
        $user->setEmail('new-email@bootcamp.pl');
        $user->setNote('User updated');
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return [];
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     */
    public function deleteAction($id)
    {
        // ...
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return $this->redirect($this->generateUrl('user_list'));
    }
    
}


