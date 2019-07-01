<?php

namespace BrasserieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;


class HoublonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $entity = $event->getData();

            $form = $event->getForm();

            $form->add('nom');
            $form->add('shortName');
            $form->add('quantite',      'number', array(
                                        'required' => false));
            $form->add('saveurs',       'entity', array(
                                        'class' => 'BrasserieBundle:Saveur',
                                        'choice_label' => 'nom',
                                        'multiple' => true,
                                        'expanded' => true,
                                        'query_builder' => function (EntityRepository $er) {
                                            return $er->createQueryBuilder('u')
                                                ->orderBy('u.nom', 'ASC');
                                        }));
            $form->add('caracteres',    'entity', array(
                                        'class' => 'BrasserieBundle:Caractere',
                                        'choice_label' => 'nom',
                                        'multiple' => true,
                                        'expanded' => true,
                                        'query_builder' => function (EntityRepository $er) {
                                            return $er->createQueryBuilder('u')
                                                ->orderBy('u.nom', 'ASC');
                                        }));
            $form->add('houblonsSimilaires',    'entity', array(
                                        'class' => 'BrasserieBundle:Houblon',
                                        'choice_label' => 'shortName',
                                        'multiple' => true,
                                        'expanded' => true,
                                        'query_builder' => function (EntityRepository $er) {
                                            return $er->createQueryBuilder('u')
                                                ->orderBy('u.nom', 'ASC');
                                        }));
            $form->add('description',   'textarea', array(
                                        'attr' => array('rows' => '3'),
                                        'required' => false));
            $form->add('commentaire',   'textarea', array(
                                        'attr' => array('rows' => '5'),
                                        'required' => false));
            $form->add('uploadedFiles', 'file', array(
                                        'label' => 'Ajouter des fichiers',
                                        'required' => false,
                                        'multiple' => true,
                                        'data_class' => null));
            $form->add('annee',         'number', array(
                                        'required' => false));
            $form->add('acideAlpha',    'number', array(
                                        'required' => false));
            $form->add('bio',           'checkbox', array(
                                        'required' => false,
                                        'label' => false,
                                        'value' => false));
            $form->add('fonction',      'choice', array(
                                        'choices'  => array(
                                            'amérisant' => "amérisant",
                                            'aromatique' => "aromatique"),
                                        'choices_as_values' => true,
                                        'multiple' => true,
                                        'expanded' => true ));
            $form->add('type',          'choice', array(
                                        'choices'  => array(
                                            'cônes' => "cônes",
                                            'pellets' => "pellets"),
                                        'choices_as_values' => true,
                                        'data' => 'pellets'));
            $form->add('pays',          'entity', array(
                                        'class' => 'BrasserieBundle:Pays',
                                        'property' => 'nom',
                                        'required' => false,
                                        'query_builder' => function (EntityRepository $er) {
                                            return $er->createQueryBuilder('u')
                                                ->orderBy('u.nom', 'ASC');
                                        }));

        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BrasserieBundle\Entity\Houblon'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brasseriebundle_houblon';
    }
}
