<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Epice;
use BrasserieBundle\Form\EpiceType;

/**
 * Epice controller.
 *
 * @Route("/epice")
 */
class EpiceController extends Controller
{

    /**
     * Lists all Epice entities.
     *
     * @Route("/", name="epice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Epice')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Epice entity.
     *
     * @Route("/", name="epice_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Epice:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Epice();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('epice_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Epice entity.
     *
     * @param Epice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Epice $entity)
    {
        $form = $this->createForm(new EpiceType(), $entity, array(
            'action' => $this->generateUrl('epice_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Epice entity.
     *
     * @Route("/new", name="epice_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Epice();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Epice entity.
     *
     * @Route("/{id}", name="epice_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Epice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Epice entity.
     *
     * @Route("/{id}/edit", name="epice_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Epice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epice entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Epice entity.
    *
    * @param Epice $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Epice $entity)
    {
        $form = $this->createForm(new EpiceType(), $entity, array(
            'action' => $this->generateUrl('epice_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Epice entity.
     *
     * @Route("/{id}", name="epice_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Epice:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Epice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('epice_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Epice entity.
     *
     * @Route("/{id}", name="epice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Epice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Epice entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('epice'));
    }

    /**
     * Creates a form to delete a Epice entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('epice_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
