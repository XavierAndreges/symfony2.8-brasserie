<?php

namespace BrasserieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;


/**
 * Levure controller.
 *
 * @Route("/api/levure")
 */
class API_LevureController extends Controller
{

    /**
     * Lists all Levure entities.
     *
     * @Route("/list", name="api_levure_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrasserieBundle:Levure')->findBy([], ['nom' => 'ASC']);

        $serializer = SerializerBuilder::create()->build();
        $serializedEntities = $serializer->serialize($entities, 'json', SerializationContext::create()->enableMaxDepthChecks());

        $data = json_decode($serializedEntities, true);

        return new JsonResponse($data);
    }
}
