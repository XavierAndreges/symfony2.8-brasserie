<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

/**
 * API Malt controller.
 *
 * @Route("/api/malt")
 */
class API_MaltController extends Controller
{

    /**
     * Lists all Malt entities.
     *
     * @Route("/quantite", name="api_malt_quantite")
     * @Method("GET")
     */
    public function quantiteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrasserieBundle:Malt')->findBy([], ['nom' => 'ASC']);

        $serializer = SerializerBuilder::create()->build();        
        $serializedEntities = $serializer->serialize($entities, 'json', SerializationContext::create()->setGroups(array('quantite')));

        return new Response($serializedEntities);
    }


    /**
     * update a Malt entity.
     *
     * @Route("/update", name="api_update_malt")
     * @Method("PUT")
     */
    public function apiUpdateAction(Request $request)
    {
        $data = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BrasserieBundle:Malt')->find($data->id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $entity->setDescription($data->description);
        $entity->setCommentaire($data->commentaire);

        $em->persist($entity);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();  
        $serializedEntity = $serializer->serialize($entity, 'json', SerializationContext::create()->setGroups(array('quantite')));
        
        return new Response($serializedEntity);
    }


    /**
     * Lists all Brassin entities.
     *
     * @Route("/list", name="api_malt_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrasserieBundle:Malt')->findBy([], ['nom' => 'ASC']);

        $serializer = SerializerBuilder::create()->build();
        
        $serializedEntities = $serializer->serialize($entities, 'json', SerializationContext::create()->setGroups(array('list')));

        return new Response($serializedEntities);
    }

}
