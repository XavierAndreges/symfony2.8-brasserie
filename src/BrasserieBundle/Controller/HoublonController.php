<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Houblon;
use BrasserieBundle\Form\HoublonType;


/**
 * Houblon controller.
 *
 * @Route("/houblon")
 */
class HoublonController extends Controller
{

    /**
     * Lists all Houblon entities.
     *
     * @Route("/", name="houblon")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Houblon')->findBy([], ['nom' => 'ASC']);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Houblon entity.
     *
     * @Route("/", name="houblon_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Houblon:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Houblon();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('brasserie.file')->saveUploadedFiles($entity, 'houblon', $entity->getNom());

            return $this->redirect($this->generateUrl('houblon_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Houblon entity.
     *
     * @param Houblon $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Houblon $entity)
    {
        $form = $this->createForm(new HoublonType(), $entity, array(
            'action' => $this->generateUrl('houblon_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Houblon entity.
     *
     * @Route("/new", name="houblon_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Houblon();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Houblon entity.
     *
     * @Route("/{id}", name="houblon_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Houblon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Houblon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Houblon entity.
     *
     * @Route("/{id}/edit", name="houblon_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Houblon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Houblon entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        dump($entity);

        return array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'ids' => $this->get('brasserie.navigation')->getOnlyIds($em->getRepository('BrasserieBundle:Houblon')->findBy([], ['nom' => 'ASC']))
        );
    }

    /**
    * Creates a form to edit a Houblon entity.
    *
    * @param Houblon $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Houblon $entity)
    {
        $form = $this->createForm(new HoublonType(), $entity, array(
            'action' => $this->generateUrl('houblon_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Houblon entity.
     *
     * @Route("/{id}", name="houblon_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Houblon:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Houblon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Houblon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('brasserie.file')->saveUploadedFiles($entity, 'houblon', $entity->getNom());

            return $this->redirect($this->generateUrl('houblon_edit', array('id' => $id)));
        }

        return array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Houblon entity.
     *
     * @Route("/{id}", name="houblon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Houblon')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Houblon entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('houblon'));
    }

    /**
     * Creates a form to delete a Houblon entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('houblon_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
