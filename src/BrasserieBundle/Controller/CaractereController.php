<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Caractere;
use BrasserieBundle\Form\CaractereType;

/**
 * Caractere controller.
 *
 * @Route("/caractere")
 */
class CaractereController extends Controller
{

    /**
     * Lists all Caractere entities.
     *
     * @Route("/", name="caractere")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Caractere')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Caractere entity.
     *
     * @Route("/", name="caractere_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Caractere:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Caractere();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('caractere_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Caractere entity.
     *
     * @param Caractere $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Caractere $entity)
    {
        $form = $this->createForm(new CaractereType(), $entity, array(
            'action' => $this->generateUrl('caractere_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Caractere entity.
     *
     * @Route("/new", name="caractere_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Caractere();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Caractere entity.
     *
     * @Route("/{id}", name="caractere_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Caractere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Caractere entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Caractere entity.
     *
     * @Route("/{id}/edit", name="caractere_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Caractere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Caractere entity.');
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
    * Creates a form to edit a Caractere entity.
    *
    * @param Caractere $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Caractere $entity)
    {
        $form = $this->createForm(new CaractereType(), $entity, array(
            'action' => $this->generateUrl('caractere_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Caractere entity.
     *
     * @Route("/{id}", name="caractere_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Caractere:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Caractere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Caractere entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('caractere_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Caractere entity.
     *
     * @Route("/{id}", name="caractere_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Caractere')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Caractere entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('caractere'));
    }

    /**
     * Creates a form to delete a Caractere entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('caractere_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
