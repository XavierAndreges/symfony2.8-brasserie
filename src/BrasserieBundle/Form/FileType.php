<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fileName',           'text', array(
                                        'required' => true))
            ->add('nameFr',             'text', array(
                                        'required' => false))
            ->add('nameEn',             'text', array(
                                        'required' => false))
            ->add('size',               'text', array(
                                        'required' => false))
            ->add('malts',              'entity', array(
                                        'class' => 'DocBundle:Malt',
                                        'choice_label' => 'nameFr'));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocBundle\Entity\File'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'docbundle_file';
    }
}
