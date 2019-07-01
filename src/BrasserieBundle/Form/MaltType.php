<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class MaltType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('ebc',            'number', array(
                                    'required' => false))
            ->add('dosageMax',      'number', array(
                                    'required' => false))
            ->add('quantite',       'number', array(
                                    'required' => false))
            ->add('saveurs',        'entity', array(
                                    'class' => 'BrasserieBundle:Saveur',
                                    'choice_label' => 'nom',
                                    'multiple' => true,
                                    'expanded' => true))
            ->add('description',    'textarea', array(
                                    'attr' => array('rows' => '3'),
                                    'required' => false))
            ->add('commentaire',    'textarea', array(
                                    'attr' => array('rows' => '5'),
                                    'required' => false))
            ->add('uploadedFiles',  'file', array(
                                    'label' => 'Ajouter des fichiers',
                                    'required' => false,
                                    'multiple' => true,
                                    'data_class' => null))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\Malt'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_malt';
    }
}
