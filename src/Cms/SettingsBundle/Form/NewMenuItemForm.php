<?php

namespace Cms\SettingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NewMenuItemForm extends AbstractType {

    public function getName() {
        return 'new_menu_item_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text', array(
                    'label' => 'Nazwa *',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'Nazwa pozycji'),
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('url', 'url', array(
                    'label' => 'Url *',
                    'required' => true,
                    'attr' => array( 'placeholder' => '/'),
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('type', 'choice', array(
                    'label' => 'Typ *',
                    'choices'   => array('NEWS' => 'Artykuł', 'VIDEO' => 'Wideo'),
                    'required'  => true,
                    'data' => 'News'
                ))
                ->add('status', 'choice', array(
                    'label' => 'Status *',
                    'choices'   => array('Nieaktywna', 'Aktywna'),
                    'required'  => true
                ))
                ->add('menu', 'entity', array(
                    'label' => 'Kontener menu * ',
                    'class' => 'CmsSettingsBundle:Menu',
                    'property' => 'name',
                    'required' => true
                ))
                ->add('send', 'submit', array(
                    'label' => 'Dodaj'
        ));
    }

}
