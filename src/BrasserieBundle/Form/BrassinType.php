<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class BrassinType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
        dump("options");
        dump($options);
        */
        $builder
            ->add('lot',            'text', array(
                                    'required' => true))
            ->add('typeBiere',      'entity', array(
                                    'class' => 'BrasserieBundle:TypeBiere',
                                    'choice_label' => 'nom',
                                    'required' => true))
            ->add('ibu',            'text', array(
                                    'required' => false))
            ->add('alcool',         'number', array(
                                    'required' => false))
            ->add('totalGrain',     'number', array(
                                    'required' => false))
            ->add('tropDeMousse',   'choice', array(
                                    'choices'  => array(
                                        '0' => 0,
                                        '1' => 1,
                                        '2' => 2,
                                        '3' => 3,
                                    ),
                                    'choices_as_values' => true,))
            ->add('vendable',       'checkbox', array(
                                    'required' => false))
            ->add('date',           new DateType(), array(
                                    'required' => false))
            ->add('embouteillage',  new EmbouteillageType(), array(
                                    'required' => false))     
            ->add('volumeDensite',  new VolumeDensiteType(), array(
                                    'required' => false))              
            ->add('empatages',      'collection', array(
                                    'type' => new EmpatageType(),
                                    'allow_add' => true,
                                    'allow_delete' => true,
                                    'by_reference' => false,
                                    'mapped' => true,
                                    'required' => false,
                                    'options' => array(
                                        'label' => true,
                                        'data_class' => 'BrasserieBundle\Entity\Empatage'
                                        )
                                    ))  
            ->add('ebulitions',     'collection', array(
                                    'type' => new EbulitionType(),
                                    'allow_add' => true,
                                    'allow_delete' => true,
                                    'by_reference' => false,
                                    'mapped' => true,
                                    'required' => false,                                 
                                    'options' => array(
                                        'label' => true,
                                        //'data_class' => 'BrasserieBundle\Entity\Ebulition'
                                        )
                                    ))
            ->add('levure',         'entity', array(
                                    'class' => 'BrasserieBundle:Levure',
                                    'query_builder' => function (EntityRepository $er) {
                                        return $er->createQueryBuilder('u')
                                            ->orderBy('u.nom', 'ASC');
                                    },
                                    'choice_label' => 'nom',
                                    'required' => false))        
            ->add('houblonACru1',   'entity', array(
                                    'class' => 'BrasserieBundle:Houblon',
                                    'choice_label' => 'nom',
                                    'query_builder' => function (EntityRepository $er) {
                                        return $er->createQueryBuilder('u')
                                            ->orderBy('u.shortName', 'ASC');
                                    },
                                    'required' => false)) 
            ->add('houblonACru2',   'entity', array(
                                    'class' => 'BrasserieBundle:Houblon',
                                    'choice_label' => 'nom',
                                    'query_builder' => function (EntityRepository $er) {
                                        return $er->createQueryBuilder('u')
                                            ->orderBy('u.shortName', 'ASC');
                                    },
                                    'required' => false)) 

            ->add('commentaire',    'textarea', array(
                                    'attr' => array('rows' => '5'),
                                    'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\Brassin'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_brassin';
    }
}
