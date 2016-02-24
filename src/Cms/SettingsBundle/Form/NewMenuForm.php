<?php

namespace Cms\SettingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NewMenuForm extends AbstractType {

    public function getName() {
        return 'new_menu_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text', array(
                    'label' => 'Nazwa *',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'Nazwa menu'),
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('type', 'choice', array(
                    'label' => 'Typ *',
                    'choices'   => array('MAIN' => 'Główne','ADDITIONAL' => 'Dodatkowe'),
                    'required'  => true
                ))
                ->add('position', 'choice', array(
                    'label' => 'Pozycja *',
                    'choices'   => array('TOP' => 'Nagłówek','BOTTOM' => 'Stopka'),
                    'required'  => true
                ))
                ->add('status', 'choice', array(
                    'label' => 'Status *',
                    'choices'   => array('Nieaktywna', 'Aktywna'),
                    'required'  => true
                ))
                ->add('send', 'submit', array(
                    'label' => 'Dodaj'
        ));
    }

}
