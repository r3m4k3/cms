<?php

namespace Cms\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AvatarForm extends AbstractType {

    public function getName() {
        return 'avatar_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('avatar', 'file', array('label' => false, 'constraints' => array(
                new Assert\Image(
                    array(
                        'mimeTypesMessage' => 'Plik nie jest obrazem.',
                        'maxWidth' => '80',
                        'maxWidthMessage' => 'Zbyt duża szerokość, wymagana to 80px.',
                        'minWidth' => '80',
                        'minWidthMessage' => 'Zbyt mała szerokość, wymagana to 80px.',
                        'maxHeight' => '80',
                        'maxHeightMessage' => 'Zbyt duża wysokość, wymagana to 80px.',
                        'minHeight' => '80',
                        'minHeightMessage' => 'Zbyt mała wysokość, wymagana to 80px',
                        'sizeNotDetectedMessage' => 'Niemożliwe jest zidentyfikowanie rozmiarów obrazu. Wgraj proszę inny. '
                    )
                ),
                new Assert\File(
                    array(
                        'maxSize' => '1024k',
                        'maxSizeMessage' => "Plik jest zbyt duży ({{ size }} {{ suffix }}). Maks. wielkość: {{ limit }} {{ suffix }}."
                    )
                ))
            ))
            ->add('save', 'submit', array('label' => 'Zapisz'));
    }

}
