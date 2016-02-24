<?php

namespace Cms\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LoginForm extends AbstractType {

    public function getName() {
        return '';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('_username', 'text', array(
                    'label' => 'Login',
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('_password', 'password', array(
                    'label' => 'Hasło',
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('send', 'submit', array(
                    'label' => 'Zaloguj'
        ));
    }

}
