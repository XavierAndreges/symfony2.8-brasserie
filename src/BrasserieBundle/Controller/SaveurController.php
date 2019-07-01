<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Saveur;
use BrasserieBundle\Form\SaveurType;

/**
 * saveur controller.
 *
 * @Route("/saveur")
 */
class SaveurController extends Controller
{

    /**
     * Lists all saveur entities.
     *
     * @Route("/", name="saveur")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Saveur')->findBy([], ['nom' => 'ASC']);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new saveur entity.
     *
     * @Route("/", name="saveur_create")
     * @Method("POST")
     * @Template("BrasserieBundle:saveur:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new saveur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('saveur_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a saveur entity.
     *
     * @param saveur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(saveur $entity)
    {
        $form = $this->createForm(new saveurType(), $entity, array(
            'action' => $this->generateUrl('saveur_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new saveur entity.
     *
     * @Route("/new", name="saveur_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new saveur();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a saveur entity.
     *
     * @Route("/{id}", name="saveur_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Saveur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find saveur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing saveur entity.
     *
     * @Route("/{id}/edit", name="saveur_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Saveur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find saveur entity.');
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
    * Creates a form to edit a saveur entity.
    *
    * @param saveur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(saveur $entity)
    {
        $form = $this->createForm(new saveurType(), $entity, array(
            'action' => $this->generateUrl('saveur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing saveur entity.
     *
     * @Route("/{id}", name="saveur_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:saveur:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Saveur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find saveur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('saveur_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a saveur entity.
     *
     * @Route("/{id}", name="saveur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Saveur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find saveur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('saveur'));
    }

    /**
     * Creates a form to delete a saveur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('saveur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
