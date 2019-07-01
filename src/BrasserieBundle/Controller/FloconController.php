<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Flocon;
use BrasserieBundle\Form\FloconType;

/**
 * Flocon controller.
 *
 * @Route("/flocon")
 */
class FloconController extends Controller
{

    /**
     * Lists all Flocon entities.
     *
     * @Route("/", name="flocon")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Flocon')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Flocon entity.
     *
     * @Route("/", name="flocon_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Flocon:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Flocon();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('flocon_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Flocon entity.
     *
     * @param Flocon $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Flocon $entity)
    {
        $form = $this->createForm(new FloconType(), $entity, array(
            'action' => $this->generateUrl('flocon_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Flocon entity.
     *
     * @Route("/new", name="flocon_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Flocon();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Flocon entity.
     *
     * @Route("/{id}", name="flocon_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Flocon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Flocon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Flocon entity.
     *
     * @Route("/{id}/edit", name="flocon_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Flocon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Flocon entity.');
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
    * Creates a form to edit a Flocon entity.
    *
    * @param Flocon $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Flocon $entity)
    {
        $form = $this->createForm(new FloconType(), $entity, array(
            'action' => $this->generateUrl('flocon_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Flocon entity.
     *
     * @Route("/{id}", name="flocon_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Flocon:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Flocon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Flocon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('flocon_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Flocon entity.
     *
     * @Route("/{id}", name="flocon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Flocon')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Flocon entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('flocon'));
    }

    /**
     * Creates a form to delete a Flocon entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('flocon_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
