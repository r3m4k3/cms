<?php

namespace Cms\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterForm extends AbstractType {

    public function getName() {
        return 'register_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', 'text', array(
                    'label' => 'Login *',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'j.doe'),
                    'constraints' => array(new Assert\NotBlank(), new Assert\Length(
                        array(
                            'min' => 4,
                            'max' => 20,
                            'minMessage' => 'Login musi zawierać min. 4 znaków. ',
                            'maxMessage' => 'Login musi zawierać maks. 20 znaków. '
                        )
                    ))
                ))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Wpisane hasła są inne. ',
                    'options' => array(
                        'attr' => array(
                            'class' => 'password-field'
                        )),
                    'required' => true,
                    'first_options' => array(
                        'label' => 'Hasło *'
                    ),
                    'second_options' => array(
                        'label' => 'Powtórz hasło *'
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
                ->add('email', 'email', array(
                    'label' => 'E-mail *',
                    'attr' => array( 'placeholder' => 'j.doe@domain.com'),
                    'required' => true
                ))
                ->add('firstname', 'text', array(
                    'label' => 'Imię *',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'John'),
                    'constraints' => array(new Assert\NotBlank())
                ))
                ->add('lastname', 'text', array(
                    'label' => 'Nazwisko *',
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
                ->add('role', 'choice', array(
                    'label' => 'Typ użytkownika *',
                    'choices'   => array('ROLE_USER' => 'Zwykły użytkownik', 'ROLE_DESIGNER' => 'Designer'),
                    'required'  => true
                ))
                ->add('captcha', 'captcha', array(
                    'label' => 'Captcha *',
                    'invalid_message' => "Wpisałeś zły kod.",
                    'quality' => 100,
                    'background_color' => array(
                        255, 255, 255
                    ),
                    'interpolation' => 'enable',
                    'as_url' => true,
                    'reload' => true
                ))
                ->add('confirm', 'checkbox', array(
                    'label' => 'Akceptuje regulamin *',
                    'required' => true,
                    'mapped' => false,
                    'constraints' => array(new Assert\NotBlank())
                ))
                ->add('reset', 'reset', array(
                    'label' => 'Wyczyść'
                ))
                ->add('send', 'submit', array(
                    'label' => 'Wyślij'
        ));
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cms\UserBundle\Entity\User'
        ));
    }

}
