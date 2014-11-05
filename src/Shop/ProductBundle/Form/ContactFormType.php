<?php
namespace Shop\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'Imię i nazwisko',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('email', 'email', [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('message', 'textarea', [
                'label' => 'Wiadomość',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
        ;
    }
    
    public function getName()
    {
        return 'contakt';
    }
}
