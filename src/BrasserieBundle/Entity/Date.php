<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Date
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Date
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Groups({"list"})
     * @ORM\Column(name="brassage", type="date", nullable=true)
     */
    private $brassage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ajoutLevure", type="date", nullable=true)
     */
    private $ajoutLevure;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="miseAuFroid", type="date", nullable=true)
     */
    private $miseAuFroid;

    /**
     * @var \DateTime
     *
     * @Groups({"list"})
     * @ORM\Column(name="embouteillage", type="date", nullable=true)
     */
    private $embouteillage;

    /**
     * @ORM\OneToOne(targetEntity="Brassin", mappedBy="date")
     */
    private $brassin;


    /**
     * Set id
     *
     * @param integer $id
     * @return Date
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



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
     * Set brassage
     *
     * @param \DateTime $brassage
     * @return Date
     */
    public function setBrassage($brassage)
    {
        $this->brassage = $brassage;

        return $this;
    }

    /**
     * Get brassage
     *
     * @return \DateTime 
     */
    public function getBrassage()
    {
        return $this->brassage;
    }

    /**
     * Set ajoutLevure
     *
     * @param \DateTime $ajoutLevure
     * @return Date
     */
    public function setAjoutLevure($ajoutLevure)
    {
        $this->ajoutLevure = $ajoutLevure;

        return $this;
    }

    /**
     * Get ajoutLevure
     *
     * @return \DateTime 
     */
    public function getAjoutLevure()
    {
        return $this->ajoutLevure;
    }

    /**
     * Set miseAuFroid
     *
     * @param \DateTime $miseAuFroid
     * @return Date
     */
    public function setMiseAuFroid($miseAuFroid)
    {
        $this->miseAuFroid = $miseAuFroid;

        return $this;
    }

    /**
     * Get miseAuFroid
     *
     * @return \DateTime 
     */
    public function getMiseAuFroid()
    {
        return $this->miseAuFroid;
    }

    /**
     * Set embouteillage
     *
     * @param \DateTime $embouteillage
     * @return Date
     */
    public function setEmbouteillage($embouteillage)
    {
        $this->embouteillage = $embouteillage;

        return $this;
    }

    /**
     * Get embouteillage
     *
     * @return \DateTime 
     */
    public function getEmbouteillage()
    {
        return $this->embouteillage;
    }

    /**
     * Set brassin
     *
     * @param \Brassin $brassin
     * @return Date
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
