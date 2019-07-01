<?php

namespace BrasserieBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use ReflectionClass;

class NavigationService
{

  private $em;
  private $container;


  public function __construct(EntityManager $em, Container $container)
  {
      $this->em = $em;
      $this->container = $container;
  }


  public function showDetailItemNavigation() {

      $hasToBeShown = false;

      $requestStack = $this->container->get('request_stack');

      $masterRequest = $requestStack->getMasterRequest(); // this is the call that breaks ESI

      if ($masterRequest) {
          $route = $masterRequest->attributes->get('_route');

          //dump($route);

          if (array_key_exists($route, $this->container->getParameter('show_detail_navigation'))) {
              return $this->container->getParameter('show_detail_navigation')[$route];
          }
      }

      return $hasToBeShown;
  }


  public function getPreviousId($entity, $ids) {

      dump("ids");
      dump($ids);

      $previousId = null;

/*
      $ref = new ReflectionClass($entity);
      $type = $ref->getShortName();
      $entities = $this->em->getRepository('DocBundle:'.$type)->findAll();
*/

      $index = null;

      foreach ($ids as $key => $id) {
        if ($id == $entity->getId()) {
          $index = $key;
        }
      }

      /*
      dump("index");
      dump($index);
*/
      if (array_key_exists($index - 1, $ids)) {
        $previousId = $ids[$index - 1];
      }

      return $previousId;
  }


  public function getNextId($entity, $ids) {

      $nextId = null;

/*
      $ref = new ReflectionClass($entity);
      $type = $ref->getShortName();
      $entities = $this->em->getRepository('DocBundle:'.$type)->findAll();
*/

      $index = null;

      foreach ($ids as $key => $id) {
        if ($id == $entity->getId()) {
          $index = $key;
        }
      }

      /*
      dump("index");
      dump($index);
*/

      if (array_key_exists($index + 1, $ids)) {
        $nextId = $ids[$index + 1];
      }

      return $nextId;
  }


  public function getOnlyIds(array $entities){

    $array = [];

    foreach ($entities as $entity) {
      $array[] = $entity->getId();
    }
/*
    dump("getOnlyIds");
    dump($entities);
    dump($array);
*/
    return $array;

  }



}
