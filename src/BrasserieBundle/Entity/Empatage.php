<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * Empatage
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Empatage
{

    public function __construct() {
        $this->brassins = new ArrayCollection();
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
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Malt", inversedBy="empatage", cascade={"persist"})
	 * @ORM\JoinColumn(name="Malt_id", referencedColumnName="id")
	 */
    private $malt;
    
    /**
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Flocon", inversedBy="empatage", cascade={"persist"})
	 * @ORM\JoinColumn(name="Flocon_id", referencedColumnName="id")
	 */
	private $flocon;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="quantite", type="float", nullable=true)
     */
    private $quantite;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="pourcentage", type="float", nullable=true)
     */
    private $pourcentage;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Brassin", mappedBy="empatages", cascade={"persist"})
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
     * Set malt
     *
     * @param \stdClass $malt
     * @return Empatage
     */
    public function setMalt($malt)
    {
        $this->malt = $malt;

        return $this;
    }

    /**
     * Get malt
     *
     * @return Malt 
     */
    public function getMalt()
    {
        return $this->malt;
    }

    /**
     * Set flocon
     *
     * @param \stdClass $flocon
     * @return Empatage
     */
    public function setFlocon($flocon)
    {
        $this->flocon = $flocon;

        return $this;
    }

    /**
     * Get flocon
     *
     * @return Flocon 
     */
    public function getFlocon()
    {
        return $this->flocon;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     * @return Empatage
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return float 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set pourcentage
     *
     * @param float $pourcentage
     * @return Empatage
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return float 
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
	 * @param $empatage
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

}
