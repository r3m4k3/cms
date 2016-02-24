<?php

namespace Cms\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ResetPasswordForm extends AbstractType {

    public function getName() {
        return 'reset_password_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Wpisane hasła są inne.',
                    'options' => array(
                        'attr' => array(
                            'class' => 'password-field'
                        )),
                    'required' => true,
                    'first_options' => array(
                        'label' => 'Nowe hasło'
                    ),
                    'second_options' => array(
                        'label' => 'Powtórz nowe hasło'
                    ),
                    'constraints' => array(new Assert\NotBlank(), new Assert\Length(
                        array(
                            'min' => 6,
                            'max' => 35,
                            'minMessage' => 'Hasło musi zawierać min. 6 znaków. ',
                            'maxMessage' => 'Hasło musi zawierać maks. 35 znaków. '
                        )
                    ))
                ))
                ->add('send', 'submit', array(
                    'label' => 'Zapisz'
        ));
    }

}
