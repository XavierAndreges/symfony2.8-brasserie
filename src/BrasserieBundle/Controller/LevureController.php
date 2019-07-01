<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BrasserieBundle\Entity\Levure;
use BrasserieBundle\Form\LevureType;

/**
 * Levure controller.
 *
 * @Route("/levure")
 */
class LevureController extends Controller
{
    /**
     * Lists all Levure entities.
     *
     * @Route("/", name="levure")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrasserieBundle:Levure')->findBy([], ['nom' => 'ASC']);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Levure entity.
     *
     * @Route("/", name="levure_create")
     * @Method("POST")
     * @Template("BrasserieBundle:Levure:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Levure();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('brasserie.file')->saveUploadedFiles($entity, 'levure', $entity->getNom());

            return $this->redirect($this->generateUrl('levure_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Levure entity.
     *
     * @param Levure $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Levure $entity)
    {
        $form = $this->createForm(new LevureType(), $entity, array(
            'action' => $this->generateUrl('levure_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Levure entity.
     *
     * @Route("/new", name="levure_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Levure();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Levure entity.
     *
     * @Route("/{id}", name="levure_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Levure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Levure entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Levure entity.
     *
     * @Route("/{id}/edit", name="levure_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Levure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Levure entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'ids' => $this->get('brasserie.navigation')->getOnlyIds($em->getRepository('BrasserieBundle:Levure')->findBy([], ['nom' => 'ASC']))
        );
    }

    /**
    * Creates a form to edit a Levure entity.
    *
    * @param Levure $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Levure $entity)
    {
        $form = $this->createForm(new LevureType(), $entity, array(
            'action' => $this->generateUrl('levure_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Levure entity.
     *
     * @Route("/{id}", name="levure_update")
     * @Method("PUT")
     * @Template("BrasserieBundle:Levure:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Levure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Levure entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('brasserie.file')->saveUploadedFiles($entity, 'levure', $entity->getNom());

            return $this->redirect($this->generateUrl('levure_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Levure entity.
     *
     * @Route("/{id}", name="levure_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrasserieBundle:Levure')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Levure entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('levure'));
    }

    /**
     * Creates a form to delete a Levure entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('levure_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
