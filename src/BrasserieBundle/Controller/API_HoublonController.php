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
 * Houblon controller.
 *
 * @Route("/api/houblon")
 */
class API_HoublonController extends Controller
{

    /**
     * update a Houblon entity.
     *
     * @Route("/update", name="api_update_houblon")
     * @Method("PUT")
     */
    public function apiUpdateAction(Request $request)
    {
        $data = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BrasserieBundle:Houblon')->find($data->id);

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
    
}
