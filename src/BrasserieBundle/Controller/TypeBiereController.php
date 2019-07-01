<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\TypeBiere;
use BrasserieBundle\Form\TypeBiereType;

/**
 * TypeBiere controller.
 *
 * @Route("/typebiere")
 */
class TypeBiereController extends Controller
{

    /**
     * Lists all TypeBiere entities.
     *
     * @Route("/", name="typebiere")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:TypeBiere')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TypeBiere entity.
     *
     * @Route("/", name="typebiere_create")
     * @Method("POST")
     * @Template("BrasserieBundle:TypeBiere:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TypeBiere();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typebiere_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TypeBiere entity.
     *
     * @param TypeBiere $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TypeBiere $entity)
    {
        $form = $this->createForm(new TypeBiereType(), $entity, array(
            'action' => $this->generateUrl('typebiere_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TypeBiere entity.
     *
     * @Route("/new", name="typebiere_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TypeBiere();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TypeBiere entity.
     *
     * @Route("/{id}", name="typebiere_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:TypeBiere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeBiere entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TypeBiere entity.
     *
     * @Route("/{id}/edit", name="typebiere_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:TypeBiere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeBiere entity.');
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
    * Creates a form to edit a TypeBiere entity.
    *
    * @param TypeBiere $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TypeBiere $entity)
    {
        $form = $this->createForm(new TypeBiereType(), $entity, array(
            'action' => $this->generateUrl('typebiere_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TypeBiere entity.
     *
     * @Route("/{id}", name="typebiere_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:TypeBiere:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:TypeBiere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeBiere entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('typebiere_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TypeBiere entity.
     *
     * @Route("/{id}", name="typebiere_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:TypeBiere')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeBiere entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typebiere'));
    }

    /**
     * Creates a form to delete a TypeBiere entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typebiere_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
