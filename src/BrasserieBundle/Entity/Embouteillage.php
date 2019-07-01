<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Embouteillage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BrasserieBundle\Entity\EmbouteillageRepository")
 */
class Embouteillage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @Groups({"list"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="nb_25", type="integer", nullable=true)
     */
    private $nb25 = 0;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="nb_33", type="integer", nullable=true)
     */
    private $nb33 = 0;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="nb_50", type="integer", nullable=true)
     */
    private $nb50 = 0;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="nb_66", type="integer", nullable=true)
     */
    private $nb66 = 0;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="nb_75", type="integer", nullable=true))
     */
    private $nb75 = 0;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="nb_600", type="integer", nullable=true)
     */
    private $nb600;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="volume", type="float", nullable=true)
     */
    private $volume;

    /**
     * @ORM\OneToOne(targetEntity="Brassin", mappedBy="embouteillage")
     */
    private $brassin;







    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nb25
     *
     * @param integer $nb25
     * @return Embouteillage
     */
    public function setNb25($nb25)
    {
        $this->nb25 = $nb25;

        return $this;
    }

    /**
     * Get nb25
     *
     * @return integer 
     */
    public function getNb25()
    {
        return $this->nb25;
    }

    /**
     * Set nb33
     *
     * @param integer $nb33
     * @return Embouteillage
     */
    public function setNb33($nb33)
    {
        $this->nb33 = $nb33;

        return $this;
    }

    /**
     * Get nb33
     *
     * @return integer 
     */
    public function getNb33()
    {
        return $this->nb33;
    }

    /**
     * Set nb50
     *
     * @param integer $nb50
     * @return Embouteillage
     */
    public function setNb50($nb50)
    {
        $this->nb50 = $nb50;

        return $this;
    }

    /**
     * Get nb50
     *
     * @return integer 
     */
    public function getNb50()
    {
        return $this->nb50;
    }

    /**
     * Set nb66
     *
     * @param integer $nb66
     * @return Embouteillage
     */
    public function setNb66($nb66)
    {
        $this->nb66 = $nb66;

        return $this;
    }

    /**
     * Get nb66
     *
     * @return integer 
     */
    public function getNb66()
    {
        return $this->nb66;
    }

    /**
     * Set nb75
     *
     * @param integer $nb75
     * @return Embouteillage
     */
    public function setNb75($nb75)
    {
        $this->nb75 = $nb75;

        return $this;
    }

    /**
     * Get nb75
     *
     * @return integer 
     */
    public function getNb75()
    {
        return $this->nb75;
    }

    /**
     * Set nb600
     *
     * @param integer $nb600
     * @return Embouteillage
     */
    public function setNb600($nb600)
    {
        $this->nb600 = $nb600;

        return $this;
    }

    /**
     * Get nb600
     *
     * @return integer 
     */
    public function getNb600()
    {
        return $this->nb600;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return Embouteillage
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set Brassin
     *
     * @param \Brassin $brassin
     * @return Brassin
     */
    public function setBrassin($brassin)
    {
        $this->brassin = $brassin;

        return $this;
    }

    /**
     * Get Brassin
     *
     * @return \Brassin 
     */
    public function getBrassin()
    {
        return $this->brassin;
    }
}
