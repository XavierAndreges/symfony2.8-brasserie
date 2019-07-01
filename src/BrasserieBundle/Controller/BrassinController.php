<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Brassin;
use BrasserieBundle\Entity\Embouteillage;
use BrasserieBundle\Form\BrassinType;

use BrasserieBundle\Entity\Empatage;
use BrasserieBundle\Entity\Ebulition;

use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

/**
 * Brassin controller.
 *
 * @Route("/brassin")
 */
class BrassinController extends Controller
{

    /**
     * Lists all Brassin entities.
     *
     * @Route("/test", name="brassin_test")
     * @Method("GET")
     */
    public function testAction()
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find(59);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }
        
        $serializer = SerializerBuilder::create()->build();
        $serializedEntity = $serializer->serialize($entities, 'json', SerializationContext::create()->enableMaxDepthChecks());

        //dump(entity);

        return new Response($serializedEntity);
    }



    /**
     * Lists all Brassin entities.
     *
     * @Route("/", name="brassin")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Brassin')->findBy([], ['lot' => 'DESC']);

       // $user = $this->get('security.token_storage')->getToken()->getUser();
        //dump($user);

        //dump($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'));

        $securityContext = $this->container->get('security.context');
        dump($securityContext->getToken());
        
        return array(
            'entities' => $entities,
        );
    }

    
    /**
     * Creates a new Brassin entity.
     *
     * @Route("/", name="brassin_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Brassin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Brassin();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();   
            $em->persist($entity);

            if ($entity->getEmbouteillage()) {
                $volumeTotal = $this->get('brasserie.utils')->calculVolumeTotal($entity->getEmbouteillage());
                $entity->getEmbouteillage()->setVolume($volumeTotal);
            }
            
            $this->get('brasserie.utils')->setQuantiteStockageMatieresPremieres($entity);

            //dump($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('brassin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'ids' => $this->get('brasserie.navigation')->getOnlyIds($em->getRepository('BrasserieBundle:Brassin')->findBy([], ['lot' => 'DESC']))
        );
    }

    /**
     * Creates a form to create a Brassin entity.
     *
     * @param Brassin $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Brassin $entity)
    {
        $form = $this->createForm(new BrassinType(), $entity, array(
            'action' => $this->generateUrl('brassin_create'),
            'method' => 'POST'
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Brassin entity.
     *
     * @Route("/new", name="brassin_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Brassin();

        $this->setNewEmpatageEbulitionIfNotExists($entity);

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'status' => 'new'
        );
    }

    /**
     * Displays a form to duplicate a Brassin entity.
     *
     * @Route("/{id}/duplicate", name="brassin_duplicate")
     * @Method("GET")
     * @Template("BrasserieBundle:Brassin:new.html.twig")
     */
    public function duplicateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);
        
        $newEntity = new Brassin();
        $newEntity = clone $entity;

        $newEntity->setId(null);
        $newEntity->setLot(null);
        $newEntity->setDate(null);
        $newEntity->setVolumeDensite(null);

        $newEmbouteillage = new Embouteillage();
        $newEntity->setEmbouteillage($newEmbouteillage);

        $em->persist($newEntity);
        $em->flush();
        
        $newEntity->setLot(null);
        $newEntity->setDate($entity->getDate());
        $newEntity->setVolumeDensite($entity->getVolumeDensite());
        $this->setNewEmpatageEbulitionIfNotExists($newEntity);

        $editForm = $this->createEditForm($newEntity);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'status' => 'duplicate'
        );
    }

    /**
     * Finds and displays a Brassin entity.
     *
     * @Route("/{id}", name="brassin_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        dump($entity);
        dump($entity->getDate());
        dump($entity->getEmpatages()->toArray());

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to edit an existing Brassin entity.
     *
     * @Route("/{id}/edit", name="brassin_edit")
     * @Method("GET")
     * @Template("BrasserieBundle:Brassin:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        
        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }

        $this->get('session')->set('brassin_edit', $entity);

        $this->setNewEmpatageEbulitionIfNotExists($entity);

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'status'        => 'edit',
            'ids' => $this->get('brasserie.navigation')->getOnlyIds($em->getRepository('BrasserieBundle:Brassin')->findBy([], ['lot' => 'DESC']))
        );
    
    }
    

    function setNewEmpatageEbulitionIfNotExists($entity) {

        dump($entity);
        dump("empatage :");
        dump($entity->getEmpatages()->toArray());
        dump ("ebulitions");
        dump($entity->getEbulitions()->toArray());

        if (count($entity->getEmpatages()) === 0) {
            $empatage = new Empatage();
            $entity->addEmpatage($empatage);
        }
        
        if (count($entity->getEbulitions()) === 0) {
            $ebulition = new Ebulition();
            $entity->addEbulition($ebulition);
        }

    }



    /**
    * Creates a form to edit a Brassin entity.
    *
    * @param Brassin $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Brassin $entity)
    {
        $form = $this->createForm(new BrassinType(), $entity, array(
            'action' => $this->generateUrl('brassin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }


    /**
     * Edits an existing Brassin entity.
     *
     * @Route("/{id}", name="brassin_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Brassin:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            if ($entity->getEmbouteillage()) {
                $volumeTotal = $this->get('brasserie.utils')->calculVolumeTotal($entity->getEmbouteillage());
                $entity->getEmbouteillage()->setVolume($volumeTotal);
            }

            $oldEntity = $this->get('session')->get('brassin_edit');
            $this->get('brasserie.utils')->updateQuantiteStockageMatieresPremieres($oldEntity, $entity);
            
            $em->flush();

            //return $this->redirect($this->generateUrl('brassin', array('id' => $id)));
            return $this->redirect($this->generateUrl('brassin_edit', array('id' => $id)));
        }

        return array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'status'        => 'edit',
            'oldEntity'     => $oldEntity
        );
    }



    /**
     * Deletes a Brassin entity.
     *
     * @Route("/{id}/delete", name="brassin_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);

        dump($entity);

        if ($entity) {
          $em->remove($entity);
          $em->flush();
        }

        return $this->redirect($this->generateUrl('brassin'));
    }

    /**
     * Creates a form to delete a Brassin entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('brassin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    /**
     * Lists all Brassin entities.
     *
     * @Route("/update/base", name="brassin_update_base")
     * @Method("GET")
     */
    public function updateBaseAction()
    {

        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('BrasserieBundle:Brassin')->findAll();
        
        if (!$entities) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }
        
        foreach ($entities as $entity) {
            
            if (count($entity->getEbulitions()) == 0) {

                if ($entity->getHoublonAmerisant1()) {
                    $ebulition = new Ebulition();
                    $ebulition->setHoublon($entity->getHoublonAmerisant1());
                    $ebulition->setDuree(70);
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();

                if ($entity->getHoublonAmerisant2()) {
                    $ebulition = new Ebulition();
                    $ebulition->setHoublon($entity->getHoublonAmerisant2());
                    $ebulition->setDuree(70);
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();

                if ($entity->getHoublonAromatique1()) {
                    $ebulition = new Ebulition();
                    $ebulition->setHoublon($entity->getHoublonAromatique1());
                    $ebulition->setDuree(10);
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();

                if ($entity->getHoublonAromatique2()) {
                    $ebulition = new Ebulition();
                    $ebulition->setHoublon($entity->getHoublonAromatique2());
                    $ebulition->setDuree(10);
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();

                if ($entity->getEpice1()) {
                    $ebulition = new Ebulition();
                    $ebulition->setEpice($entity->getEpice1());
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();
        
                if ($entity->getEpice2()) {
                    $ebulition = new Ebulition();
                    $ebulition->setEpice($entity->getEpice2());
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();
        
                if ($entity->getEpice3()) {
                    $ebulition = new Ebulition();
                    $ebulition->setEpice($entity->getEpice3());
                    $ebulition->addBrassin($entity);
                    $entity->addEbulition($ebulition);
                }
                $em->flush();

            }
        }

        return new Response(count($entities));
    }
    
    

}
