<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EbulitionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite',   'number', array(
                                'required' => false))
            ->add('duree',       'number', array(
                                'required' => false))
            ->add('houblon',    'entity', array(
                                'class' => 'BrasserieBundle:Houblon',
                                'query_builder' => function (EntityRepository $er) {
                                    return $er->createQueryBuilder('u')
                                        ->orderBy('u.nom', 'ASC');
                                },
                                'choice_label' => 'nom',
                                'required' => false))   
            ->add('epice',      'entity', array(
                                'class' => 'BrasserieBundle:Epice',
                                'choice_label' => 'nom',
                                'required' => false))  
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\Ebulition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_ebulition';
    }
}
