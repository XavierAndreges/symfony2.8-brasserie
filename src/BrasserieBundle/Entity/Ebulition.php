<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * Ebulition
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ebulition
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
     * @var integer
     * @Groups({"list"})
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var houblon
     * 
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Houblon", inversedBy="ebulitions", cascade={"persist"})
	 * @ORM\JoinColumn(name="Houblon_id", referencedColumnName="id")
	 */
    private $houblon;

    /**
     * @var \epice
     *
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Epice", inversedBy="ebulitions", cascade={"persist"})
	 * @ORM\JoinColumn(name="Epice_id", referencedColumnName="id")
     */
    private $epice;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Brassin", mappedBy="ebulitions", cascade={"persist"})
     */
    private $brassins;


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
     * Set quantite
     *
     * @param integer $quantite
     * @return Ebulition
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Ebulition
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set houblon
     *
     * @param Houblon $houblon
     * @return Ebulition
     */
    public function setHoublon($houblon)
    {
        $this->houblon = $houblon;

        return $this;
    }

    /**
     * Get Houblon
     *
     * @return array 
     */
    public function getHoublon()
    {
        return $this->houblon;
    }

    /**
     * Set epice
     *
     * @return Ebulition
     */
    public function setEpice($epice)
    {
        $this->epice = $epice;

        return $this;
    }

    /**
     * Get Epice
     *
     * @return Epice 
     */
    public function getEpice()
    {
        return $this->epice;
    }

    /**
	 * @param $brassin
	 */
	public function addBrassin(Brassin $brassin)
	{
        $this->brassins[] = $brassin;

        return $this;
    }
    
    /**
     * Remove brassin.
     *
     */
    public function removeBrassin(Brassin $brassin)
    {
        $this->brassins->removeElement($empatage);
    }

    /**
     * Get Brassin
     *
     * @return \Brassin 
     */
    public function getBrassins()
    {
        return $this->brassins;
    }


    public function __construct()
    {
        $this->brassins = new ArrayCollection();
    }
}
