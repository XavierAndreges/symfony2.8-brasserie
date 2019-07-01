<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmbouteillageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb25',       'text', array(
                                'required' => false,
                                'empty_data' => 0
                                )
                                )
            ->add('nb33',       'text', array(
                                'required' => false,
                                'empty_data' => 0
                                )
                                )
            ->add('nb50',       'text', array(
                                'required' => false,
                                'empty_data' => 0
                                )
                                )
            ->add('nb66',       'text', array(
                                'required' => false,
                                'empty_data' => 0
                                )
                                )
            ->add('nb75',       'text', array(
                                'required' => false,
                                'empty_data' => 0
                                )
                                )
            ->add('nb600')
            ->add('volume',     'text', array(
                                'required' => false,
                                'read_only' => true))
            ->add('brassin',    'entity', array(
                                'class' => 'BrasserieBundle:Brassin',
                                'choice_label' => 'lot',
                                'required' => false,
                                'disabled' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\Embouteillage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_embouteillage';
    }
}
