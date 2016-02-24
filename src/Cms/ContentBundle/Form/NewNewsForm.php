<?php

namespace Cms\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NewNewsForm extends AbstractType {

    public function getName() {
        return 'new_news_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array(
                    'label' => 'Tytuł *',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'Tytuł'),
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('subtitle', 'text', array(
                    'label' => 'Podtytuł',
                    'required' => false,
                    'attr' => array( 'placeholder' => 'Podtytuł')
                ))
                ->add('category', 'entity', array(
                    'label' => 'Kategoria *',
                    'class' => 'CmsContentBundle:Category',
                    'property' => 'name',
                    'required'  => true
                ))
                ->add('publish_start_date', 'datetime', array(
                    'label' => 'Data publikacji od *',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'attr' => array('class' => 'datetimepicker'),
                    'required'  => true,
                    'data' => new \DateTime()
                ))
                ->add('publish_end_date', 'datetime', array(
                    'label' => 'Data publikacji do',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm:ss',
                    'attr' => array('class' => 'datetimepicker'),
                    'required'  => false
                ))
                ->add('status', 'choice', array(
                    'label' => 'Status *',
                    'choices'   => array('Niekatywna', 'Szkic', 'Aktywna'),
                    'required'  => true
                ))
                ->add('main_photo_id', 'file', array(
                    'label' => 'Główne zdjęcie',
                    'required'  => false
                ))
                ->add('main_object_in_content_id', 'file', array(
                    'label' => 'Główne multimedium w tle',
                    'required'  => false
                ))
                ->add('forum_enabled', 'checkbox', array(
                    'label' => 'Forum',
                    'required'  => false,
                    'data' => true
                ))
                ->add('social_media_enabled', 'checkbox', array(
                    'label' => 'Social media',
                    'required'  => false,
                    'data' => true
                ))
                ->add('initial_content', 'textarea', array(
                    'label' => 'Treść wstępna',
                    'required'  => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                ))
                ->add('content', 'textarea', array(
                    'label' => 'Treść *',
                    'required'  => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                ))
                ->add('tags', 'text', array(
                    'label' => 'Tagi',
                    'required'  => false,
                    'attr' => array(
                        'data-role' => 'tagsinput'
                    )
                ))
                ->add('send', 'submit', array(
                    'label' => 'Dodaj'
        ));
    }

}
