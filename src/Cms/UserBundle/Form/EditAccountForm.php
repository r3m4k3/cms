<?php

namespace Cms\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class EditAccountForm extends AbstractType {

    public function getName() {
        return 'edit_account_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('email', 'email', array(
                    'label' => 'E-mail',
                    'attr' => array( 'placeholder' => 'j.doe@domain.com'),
                    'required' => true
                ))
                ->add('firstname', 'text', array(
                    'label' => 'Imię',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'John'),
                    'constraints' => array(new Assert\NotBlank())
                ))
                ->add('lastname', 'text', array(
                    'label' => 'Nazwisko',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'Doe'),
                    'constraints' => array(new Assert\NotBlank())
                ))
                ->add('phone', 'text', array(
                    'label' => 'Telefon',
                    'required' => false,
                    'attr' => array( 'placeholder' => '123456789'),
                    'constraints' => array(new Assert\Length(
                        array(
                            'min' => 9,
                            'max' => 9,
                            'exactMessage' => 'Numer telefonu musi mieć 9 znaków. '
                            )
                        ))
                ))
                ->add('website', 'text', array(
                    'label' => 'Strona www',
                    'required' => false,
                    'attr' => array( 'placeholder' => 'domain.com')
                ))
                ->add('reset', 'reset', array(
                    'label' => 'Wyczyść'
                ))
                ->add('send', 'submit', array(
                    'label' => 'Zapisz zmiany'
        ));
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cms\UserBundle\Entity\User'
        ));
    }

}
