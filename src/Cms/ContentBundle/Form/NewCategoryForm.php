<?php

namespace Cms\ContentBundle\Form;

use Cms\ContentBundle\Entity\Category;
use Cms\ContentBundle\Entity\Province;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewCategoryForm extends AbstractType {

    private $cities;

    public function getName() {
        return 'new_category_form';
    }

    public function __construct($cities) {
        $this->cities = $cities;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
                ->add('name', 'text', array(
                    'label' => 'Nazwa *',
                    'required' => true,
                    'attr' => array( 'placeholder' => 'Nazwa kategorii'),
                    'constraints' => array(
                        new Assert\NotBlank()
                    )
                ))
                ->add('data_type', 'choice', array(
                    'label' => 'Typ kategorii *',
                    'choices'   => array('NEWS' => 'Artykuł', 'VIDEO' => 'Wideo'),
                    'required'  => true,
                    'data' => 'NEWS'
                ))
                ->add('supercategory', 'entity', array(
                    'label' => 'Kategoria nadrzędna',
                    'class' => 'CmsContentBundle:Category',
                    'property' => 'name',
                    'placeholder' => '-- Brak --',
                    'empty_data'  => null,
                    'required' => false
                ))
                ->add('province', 'entity', array(
                    'label' => 'Województwo',
                    'class' => 'CmsContentBundle:Province',
                    'property' => 'name',
                    'placeholder' => '-- Brak --',
                    'empty_data'  => null,
                    'required' => false
                ))
                ->add('city', 'choice', array(
                    'label' => 'Miasto',
                    'choices' => $this->cities,
                    'placeholder' => '-- Brak --',
                    'empty_data'  => null,
                    'required' => false
                ))
                ->add('default_sort_type', 'choice', array(
                    'label' => 'Typ sortowania *',
                    'choices'   => array('NEWEST' => 'Najnowsze', 'MOST_COMMENTED' => 'Najczęściej komentowane', 'MOST_VIEWED' => 'Najpopularniejsze'),
                    'required'  => true
                ))
                ->add('status', 'choice', array(
                    'label' => 'Status *',
                    'choices'   => array('Nieaktywna','Aktywna'),
                    'required'  => true
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

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cms\ContentBundle\Entity\Category'
        ));
    }

}
