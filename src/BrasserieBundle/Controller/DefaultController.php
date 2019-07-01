<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;



class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        dump($this->$user);
        
        return array('name' => $name);
    }
    
    /**
     * Lists all quantities
     *
     * @Route("/api/quantite", name="api_quantite")
     * @Method("GET")
     */
    public function quantiteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $malts = $em->getRepository('BrasserieBundle:Malt')->findBy([], ['nom' => 'ASC']);
        $flocons = $em->getRepository('BrasserieBundle:Flocon')->findBy([], ['nom' => 'ASC']);
        $houblons = $em->getRepository('BrasserieBundle:Houblon')->findBy([], ['nom' => 'ASC']);
        $epices = $em->getRepository('BrasserieBundle:Epice')->findBy([], ['nom' => 'ASC']);
        $levures = $em->getRepository('BrasserieBundle:Levure')->findBy([], ['nom' => 'ASC']);

        $entities = ["malt" => $malts, "flocon" => $flocons, "houblon" => $houblons, "epice" => $epices, "levure" => $levures];

        $serializer = SerializerBuilder::create()->build();        
        $serializedEntities = $serializer->serialize($entities, 'json', SerializationContext::create()->setGroups(array('quantite')));

        return new Response($serializedEntities);
    }


    /**
     * update ingredient entity.
     *
     * @Route("/api/ingredient/update", name="api_update_ingredient")
     * @Method("put")
     */
    public function apiUpdateIngredientAction(Request $request)
    {
        $data = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BrasserieBundle:'.$data->category)->find($data->id);

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
     * Deletes a File entity.
     *
     * @Route("/file/{id}/delete", name="delete_file")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BrasserieBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $this->get('brasserie.file')->removeUpload($entity->getFileName());
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('malt'));
    }
}
