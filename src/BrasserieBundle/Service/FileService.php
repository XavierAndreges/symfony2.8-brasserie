<?php

namespace BrasserieBundle\Service;

use BrasserieBundle\Entity\File;
use Doctrine\ORM\EntityManager;


class FileService
{

  private $em;
  private $file_ulpload_dir;


  public function __construct(EntityManager $em, $file_ulpload_dir)
  {
      $this->em = $em;
      $this->file_ulpload_dir = $file_ulpload_dir;
  }


  public function saveUploadedFiles($entity, $type, $name) 
  {
      $uploadedFiles = $entity->getUploadedFiles();

      dump($uploadedFiles);

      if ($uploadedFiles && count($uploadedFiles) > 0 && $uploadedFiles[0] != null) {

          $name = $name."_".$entity->getId()."_";
          
          $number = 0;

          if (count($entity->getFiles()) > 0) 
          {
              $lastFile = $entity->getFiles()[count($entity->getFiles()) - 1];
              $lastFileArray = explode(".", $lastFile->getFileName());
              $number = substr($lastFileArray[0], strlen($lastFileArray[0]) - 1);    
          }      

          $i = $number + 1;

          foreach($uploadedFiles as $uploadedFile)
          {
            $file = new File();

            $fileName = $this->setAndCopyFile($file, $uploadedFile, $type, $name.$i);

            $entity->getFiles()->add($file);

            switch ($type) 
            {
                case 'malt':
                $file->getMalts()->add($entity);
                break;

                case 'houblon':
                $file->getHoublons()->add($entity);
                break;
            }     

            $i++;

            unset($uploadedFile);

            dump($file);

            $this->em->flush();

            dump($entity);
          }
      }
  }


    public function setAndCopyFile(File $file, $uploadedFile, $type, $name) 
    {
        $fileName = $this->getFileName($uploadedFile, $name);
        $file->setFileName($type."/".$fileName);

        $file->setSize($uploadedFile->getClientSize());

        $file->setNameFr($uploadedFile->getClientOriginalName());
        $file->setNameEn($uploadedFile->getClientOriginalName());

        $dir = $this->file_ulpload_dir;

        dump($dir."/".$type);

        $uploadedFile->move($dir."/".$type, $fileName);

        return $fileName;
    }


  public function getFileName($uploadedFile, $name)
  {
      $fileName = $this->remove_accents($name);
      dump("getFileName uploadedFile");
      dump($uploadedFile);
      $fileName = trim($fileName).'.'.$uploadedFile->guessExtension();
      return $fileName;
  }


	function remove_accents($str, $charset='utf-8') 
  {
    	$str = htmlentities($str, ENT_NOQUOTES, $charset);
    
    	$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    	$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    	$str = preg_replace('/\s/', '_', $str); 
      $str = str_replace(array("'", '"'), "_", $str);

    	return $str;
	}


  public function removeFile($file) 
  {
      $this->removeUpload($file->getFileName());
      $this->em->remove($file);
  }


  public function removeFiles($files) 
  {
      if(count($files) > 0) {
        for ($i = 0; $i < count($files); $i++) {
          $this->removeUpload($files[$i]->getFileName());
          $this->em->remove($files[$i]);
        }  
      }
  }


  public function removeUpload($name)
  {
    $path = $this->file_ulpload_dir."/".$name;

    //dump($path);

    if (is_file($path)) {
        unlink($path);
    }
  }


  public function getNameUsedForEntityFile($entity, $type) {

      $name = "";

      switch ($type) 
      {
          case 'structure':
          $name = $entity->getName();
          break;
        
          case 'work':
          $name = $entity->getNameFr();
          break;

          case 'job':
          $name = $entity->getName();
          break;

          case 'techno':
          $name = $entity->getName();
          break;
      } 

      return $name;
  }


}