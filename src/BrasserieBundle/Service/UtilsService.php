<?php

namespace BrasserieBundle\Service;

use Doctrine\ORM\EntityManager;

class UtilsService
{

    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function calculVolumeTotal($entity) {
        $volumeCl = ($entity->getNb25() * 25) +  ($entity->getNb33() * 33) 
        +  ($entity->getNb66() * 66) +  ($entity->getNb75() * 75);
        return $volumeCl / 100;
    }


    public function setQuantiteStockageMatieresPremieres($entity) {

        foreach ($entity->getEmpatages() as $empatage) { 

            dump($empatage);

            if ($empatage->getMalt()) {
                dump($empatage->getMalt());
                $newQuantite = $empatage->getMalt()->getQuantite() - $empatage->getQuantite();
                $empatage->getMalt()->setQuantite($newQuantite);
            };

            if ($empatage->getFlocon()) {
                dump($empatage->getFlocon());
                $newQuantite = $empatage->getFlocon()->getQuantite() - $empatage->getQuantite();
                $empatage->getFlocon()->setQuantite($newQuantite);
            };
        }

        foreach ($entity->getEbulitions() as $ebulition) { 

            dump($ebulition);

            if ($ebulition->getHoublon()) {
                $newQuantite = $ebulition->getHoublon()->getQuantite() - $ebulition->getQuantite();
                $ebulition->getHoublon()->setQuantite($newQuantite);
            };

            if ($ebulition->getEpice()) {
                $newQuantite = $ebulition->getEpice()->getQuantite() - $ebulition->getQuantite();
                $ebulition->getEpice()->setQuantite($newQuantite);
            };
        }
    }


    public function updateQuantiteStockageMatieresPremieres($oldEntity, $newEntity) { 

        
        dump($oldEntity);
        dump($newEntity);

        /*********************************** EMPATAGE   *******************************************/

        $oldMaltIdsArray = array();
        $oldFloconIdsArray = array();

        foreach ($oldEntity->getEmpatages() as $empatage) { 

            if ($empatage->getMalt()) {
                $oldMaltIdsArray[] = $empatage->getMalt()->getId();
            } 
            
            if ($empatage->getFlocon()) {
                $oldFloconIdsArray[] = $empatage->getFlocon()->getId();
            }
        }


        foreach ($newEntity->getEmpatages() as $empatage) { 

            if ($empatage->getMalt()) {

                if (!in_array($empatage->getMalt()->getId(), $oldMaltIdsArray)) {

                    $newQuantite = $empatage->getMalt()->getQuantite() - $empatage->getQuantite();  

                    dump("Get ".$empatage->getMalt()->getNom()." Malt NOT in Array => newQuantite : ".$newQuantite);

                } else {

                    foreach ($oldEntity->getEmpatages() as $oldEmpatage) { 

                        if ($oldEmpatage->getId() == $empatage->getId()) {
                            $difference = $oldEmpatage->getQuantite() - $empatage->getQuantite();
                            $newQuantite = $empatage->getMalt()->getQuantite() + $difference;

                            dump("Get ".$empatage->getMalt()->getNom()." Malt in Array => newQuantite : ".$newQuantite);
                        } 
                    }   
                }

                $empatage->getMalt()->setQuantite($newQuantite);
            } 
            
            if ($empatage->getFlocon()) {

                if (!in_array($empatage->getFlocon()->getId(), $oldFloconIdsArray)) {

                    $newQuantite = $empatage->getFlocon()->getQuantite() - $empatage->getQuantite();
                    
                } else {

                    foreach ($oldEntity->getEmpatages() as $oldEmpatage) { 

                        if ($oldEmpatage->getId() == $empatage->getId()) {
                            $difference = $oldEmpatage->getQuantite() - $empatage->getQuantite();
                            $newQuantite = $empatage->getFlocon()->getQuantite() + $difference;
                        } 
                    } 

                }

                $empatage->getFlocon()->setQuantite($newQuantite);
            }
             
        }

        /*********************************** EBULITION   *******************************************/

        $oldHoublonIdsArray = array();
        $oldEpiceIdsArray = array();

        foreach ($oldEntity->getEbulitions() as $ebulition) { 

            if ($ebulition->getHoublon()) {
                $oldHoublonIdsArray[] = $ebulition->getHoublon()->getId();
            } 
            
            if ($ebulition->getEpice()) {
                $oldEpiceIdsArray[] = $ebulition->getEpice()->getId();
            }
        }

        foreach ($newEntity->getEbulitions() as $ebulition) { 

            if ($ebulition->getHoublon()) {

                if (!in_array($ebulition->getHoublon()->getId(), $oldHoublonIdsArray)) {

                    $newQuantite = $ebulition->getHoublon()->getQuantite() - $ebulition->getQuantite();  

                    dump("Get ".$ebulition->getHoublon()->getNom()." Houblon NOT in Array => newQuantite : ".$newQuantite);

                } else {

                    foreach ($oldEntity->getEbulitions() as $oldEbulition) { 

                        if ($oldEbulition->getId() == $ebulition->getId()) {
                            $difference = $oldEbulition->getQuantite() - $ebulition->getQuantite();
                            $newQuantite = $ebulition->getHoublon()->getQuantite() + $difference;

                            dump("Get ".$ebulition->getHoublon()->getNom()." houblon in Array => newQuantite : ".$newQuantite);
                        } 
                    }   
                }

                $ebulition->getHoublon()->setQuantite($newQuantite);
            } 
            
            if ($ebulition->getEpice()) {

                if (!in_array($ebulition->getEpice()->getId(), $oldEpiceIdsArray)) {

                    $newQuantite = $ebulition->getEpice()->getQuantite() - $ebulition->getQuantite();
                    
                } else {

                    foreach ($oldEntity->getEbulitions() as $oldEbulition) { 

                        if ($oldEbulition->getId() == $ebulition->getId()) {
                            $difference = $oldEbulition->getQuantite() - $ebulition->getQuantite();
                            $newQuantite = $ebulition->getEpice()->getQuantite() + $difference;
                        } 
                    } 

                }

                $ebulition->getEpice()->setQuantite($newQuantite);
            }       
        }
    }



    public function getConcatenateTagsInLine($tags, $symbol) {

        $string = "";
  
        $i = 0;
        $len = count($tags);
  
        foreach  ($tags as $tag) {
  
            $string .= $tag->getNom();
  
            if ($i < $len - 1) {
                $string .= $symbol." ";
            }
  
            $i++;
        }
  
        return $string;
    }


}
