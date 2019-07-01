<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Table(name="files")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class File
{

    public function __construct() {
        $this->malts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houblons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nameFr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nameEn;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @ORM\ManyToMany(targetEntity="Malt", mappedBy="files")
     **/
    private $malts;

    /**
     * @ORM\ManyToMany(targetEntity="Houblon", mappedBy="files")
     **/
    private $houblons;

    /**
     * @ORM\ManyToMany(targetEntity="Levure", mappedBy="files")
     **/
    private $levures;



        /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fileName.
     *
     * @param string $fileName
     *
     * @return file
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set nameFr.
     *
     * @param string $nameFr
     *
     * @return file
     */
    public function setNameFr($nameFr)
    {
        $this->nameFr = $nameFr;

        return $this;
    }

    /**
     * Get nameFr.
     *
     * @return string
     */
    public function getNameFr()
    {
        return $this->nameFr;
    }

    /**
     * Set nameEn.
     *
     * @param string $nameEn
     *
     * @return file
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn.
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set size.
     *
     * @param integer $size
     *
     * @return file
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size.
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set file.
     *
     * @param file
     *
     * @return file
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * set File.
     *
     * @return File
     */
    public function setMalts($malts)
    {
        $this->malts = $malts;

        return $this;
    }

    /**
     * Get works.
     *
     * @return malts
     */
    public function getMalts()
    {
        return $this->malts;
    }

    /**
     * set File.
     *
     * @return File
     */
    public function setHoublons($houblons)
    {
        $this->houblons = $houblons;

        return $this;
    }

    /**
     * Get works.
     *
     * @return malts
     */
    public function getHoublons()
    {
        return $this->houblons;
    }

    /**
     * set levures.
     *
     * @return File
     */
    public function setLevures($levures)
    {
        $this->levures = $levures;

        return $this;
    }

    /**
     * Get levures.
     *
     * @return levures
     */
    public function getLevures()
    {
        return $this->levures;
    }
}