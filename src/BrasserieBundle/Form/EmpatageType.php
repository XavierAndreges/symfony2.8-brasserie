<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EmpatageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('malt',       'entity', array(
                                'class' => 'BrasserieBundle:Malt',
                                'query_builder' => function (EntityRepository $er) {
                                    return $er->createQueryBuilder('u')
                                        ->orderBy('u.nom', 'ASC');
                                },
                                'choice_label' => 'nom',
                                'required' => false))   
            ->add('flocon',     'entity', array(
                                'class' => 'BrasserieBundle:Flocon',
                                'choice_label' => 'nom',
                                'required' => false))  
            ->add('quantite')
            ->add('pourcentage')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\Empatage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_empatage';
    }
}
