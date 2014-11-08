<?php
namespace Shop\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ContactFormType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'Imię i nazwisko',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints'   => new NotBlank()
            ])
            ->add('email', 'email', [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints'   => [new NotBlank(), new Email()]
            ])
            ->add('message', 'textarea', [
                'label' => 'Wiadomość',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints'   => new NotBlank()
            ])
        ;
    }
    
    public function getName()
    {
        return 'contakt';
    }
}
