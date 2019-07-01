<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Date;
use BrasserieBundle\Form\DateType;

/**
 * Date controller.
 *
 * @Route("/date")
 */
class DateController extends Controller
{

    /**
     * Lists all Date entities.
     *
     * @Route("/", name="date")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Date')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Date entity.
     *
     * @Route("/", name="date_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Date:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Date();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('date_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Date entity.
     *
     * @param Date $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Date $entity)
    {
        $form = $this->createForm(new DateType(), $entity, array(
            'action' => $this->generateUrl('date_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Date entity.
     *
     * @Route("/new", name="date_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Date();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Date entity.
     *
     * @Route("/{id}", name="date_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Date')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Date entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Date entity.
     *
     * @Route("/{id}/edit", name="date_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Date')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Date entity.');
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
    * Creates a form to edit a Date entity.
    *
    * @param Date $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Date $entity)
    {
        $form = $this->createForm(new DateType(), $entity, array(
            'action' => $this->generateUrl('date_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Date entity.
     *
     * @Route("/{id}", name="date_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Date:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Date')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Date entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('date_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Date entity.
     *
     * @Route("/{id}", name="date_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Date')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Date entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('date'));
    }

    /**
     * Creates a form to delete a Date entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('date_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
