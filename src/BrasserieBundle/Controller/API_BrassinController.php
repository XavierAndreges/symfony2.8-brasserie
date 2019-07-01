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
 * Brassin controller.
 *
 * @Route("/api/brassin")
 */
class API_BrassinController extends Controller
{
    /**
     * Lists all Brassin entities.
     *
     * @Route("/list", name="api_brassin_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrasserieBundle:Brassin')->findBy([], ['lot' => 'ASC']);

        //$serializedEntities = $this->container->get('serializer')->serialize($entities, 'json');
        $serializer = SerializerBuilder::create()->build();
        //$serializedEntities = $serializer->serialize($entities, 'json', SerializationContext::create()->enableMaxDepthChecks());
        
        $serializedEntities = $serializer->serialize($entities, 'json', SerializationContext::create()->setGroups(array('list')));

        
        return new Response($serializedEntities);
    }


    /**
     * Edit QUANTITY Brassin entity .
     *
     * @Route("/quantity/{id}/{typeEmbouteillage}/{value}", name="api_brassin_update_quantity")
     * @Method("GET")
     */
    public function updateQuantityAction(Request $request, $id, $typeEmbouteillage, $value)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }

        $functionNameGet = "getNb".$typeEmbouteillage;
        $functionNameSet = "setNb".$typeEmbouteillage;

        $nb = $entity->getEmbouteillage()->$functionNameGet();
        $entity->getEmbouteillage()->$functionNameSet($nb + $value);
        
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $serializedEntity = $serializer->serialize($entity, 'json', SerializationContext::create()->setGroups(array('list')));
        return new Response($serializedEntity);
    }


    /**
     * update a Brassin entity.
     *
     * @Route("/update", name="api_update_brassin")
     * @Method("PUT")
     */
    public function apiUpdateAction(Request $request)
    {
        $data = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($data->id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $entity->setCommentaire($data->commentaire);

        $em->persist($entity);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();  
        $serializedEntity = $serializer->serialize($entity, 'json', SerializationContext::create()->setGroups(array('list')));
        
        return new Response($serializedEntity);
    }



    /**
     * update vendable Brassin entity .
     *
     * @Route("/vendable/{id}/{value}", name="api_brassin_update_vendable")
     * @Method("GET")
     */
    public function updateVendableAction(Request $request, $id, $value)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }

        $entity->setVendable($value);
        
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $serializedEntity = $serializer->serialize($entity, 'json', SerializationContext::create()->setGroups(array('list')));
        return new Response($serializedEntity);
    }


    /**
     * update tropDeMousse Brassin entity .
     *
     * @Route("/tropdemousse/{id}/{value}", name="api_brassin_update_trop_de_mousse")
     * @Method("GET")
     */
    public function updateTropDeMousseAction(Request $request, $id, $value)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrasserieBundle:Brassin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brassin entity.');
        }

        $entity->setTropDeMousse($value);
        
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $serializedEntity = $serializer->serialize($entity, 'json', SerializationContext::create()->setGroups(array('list')));
        return new Response($serializedEntity);
    }
}
