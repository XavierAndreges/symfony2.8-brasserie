<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VolumeDensiteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vDebutEmpatage')
            ->add('vFinEmpatage')
            ->add('dFinEmpatage')
            ->add('vRincage')
            ->add('vDebutEbu')
            ->add('dDebutEbu')
            ->add('vFinEbu')
            ->add('dFinEbu')
            ->add('vEmbouteillage')
            ->add('dEmbouteillage')
            ->add('sucreLitre')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\VolumeDensite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_volumedensite';
    }
}
