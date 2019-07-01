<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * VolumeDensite
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class VolumeDensite
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
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="v_debut_empatage", type="float", nullable=true)
     */
    private $vDebutEmpatage;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="v_fin_empatage", type="float", nullable=true)
     */
    private $vFinEmpatage;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="d_fin_empatage", type="float", nullable=true)
     */
    private $dFinEmpatage;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="v_rincage", type="float", nullable=true)
     */
    private $vRincage;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="v_debut_ebu", type="float", nullable=true)
     */
    private $vDebutEbu;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="d_debut_ebu", type="float", nullable=true)
     */
    private $dDebutEbu;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="v_fin_ebu", type="float", nullable=true)
     */
    private $vFinEbu;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="d_fin_ebu", type="float", nullable=true)
     */
    private $dFinEbu;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="v_embouteillage", type="float", nullable=true)
     */
    private $vEmbouteillage;

    /**
     * @var float
     *
     * @Groups({"list", "quantite"})
     * @ORM\Column(name="d_embouteillage", type="float", nullable=true)
     */
    private $dEmbouteillage;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="sucre_litre", type="float", nullable=true)
     */
    private $sucreLitre;

    /**
     * @ORM\OneToOne(targetEntity="Brassin", mappedBy="volumeDensite")
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
     * Set vDebutEmpatage
     *
     * @param float $vDebutEmpatage
     * @return VolumeDensite
     */
    public function setVDebutEmpatage($vDebutEmpatage)
    {
        $this->vDebutEmpatage = $vDebutEmpatage;

        return $this;
    }

    /**
     * Get vDebutEmpatage
     *
     * @return float 
     */
    public function getVDebutEmpatage()
    {
        return $this->vDebutEmpatage;
    }

    /**
     * Set vFinEmpatage
     *
     * @param float $vFinEmpatage
     * @return VolumeDensite
     */
    public function setVFinEmpatage($vFinEmpatage)
    {
        $this->vFinEmpatage = $vFinEmpatage;

        return $this;
    }

    /**
     * Get vFinEmpatage
     *
     * @return float 
     */
    public function getVFinEmpatage()
    {
        return $this->vFinEmpatage;
    }

    /**
     * Set dFinEmpatage
     *
     * @param float $dFinEmpatage
     * @return VolumeDensite
     */
    public function setDFinEmpatage($dFinEmpatage)
    {
        $this->dFinEmpatage = $dFinEmpatage;

        return $this;
    }

    /**
     * Get dFinEmpatage
     *
     * @return float 
     */
    public function getDFinEmpatage()
    {
        return $this->dFinEmpatage;
    }


    /**
     * Set vRincage
     *
     * @param float $vRincage
     * @return VolumeDensite
     */
    public function setVRincage($vRincage)
    {
        $this->vRincage = $vRincage;

        return $this;
    }

    /**
     * Get vRincage
     *
     * @return float 
     */
    public function getVRincage()
    {
        return $this->vRincage;
    }

    /**
     * Set vDebutEbu
     *
     * @param float $vDebutEbu
     * @return VolumeDensite
     */
    public function setVDebutEbu($vDebutEbu)
    {
        $this->vDebutEbu = $vDebutEbu;

        return $this;
    }

    /**
     * Get vDebutEbu
     *
     * @return float 
     */
    public function getVDebutEbu()
    {
        return $this->vDebutEbu;
    }

    /**
     * Set dDebutEbu
     *
     * @param float $dDebutEbu
     * @return VolumeDensite
     */
    public function setDDebutEbu($dDebutEbu)
    {
        $this->dDebutEbu = $dDebutEbu;

        return $this;
    }

    /**
     * Get dDebutEbu
     *
     * @return float 
     */
    public function getDDebutEbu()
    {
        return $this->dDebutEbu;
    }

    /**
     * Set vFinEbu
     *
     * @param float $vFinEbu
     * @return VolumeDensite
     */
    public function setVFinEbu($vFinEbu)
    {
        $this->vFinEbu = $vFinEbu;

        return $this;
    }

    /**
     * Get vFinEbu
     *
     * @return float 
     */
    public function getVFinEbu()
    {
        return $this->vFinEbu;
    }

    /**
     * Set dFinEbu
     *
     * @param float $dFinEbu
     * @return VolumeDensite
     */
    public function setDFinEbu($dFinEbu)
    {
        $this->dFinEbu = $dFinEbu;

        return $this;
    }

    /**
     * Get dFinEbu
     *
     * @return float 
     */
    public function getDFinEbu()
    {
        return $this->dFinEbu;
    }

    /**
     * Set vEmbouteillage
     *
     * @param float $vEmbouteillage
     * @return VolumeDensite
     */
    public function setVEmbouteillage($vEmbouteillage)
    {
        $this->vEmbouteillage = $vEmbouteillage;

        return $this;
    }

    /**
     * Get vEmbouteillage
     *
     * @return float 
     */
    public function getVEmbouteillage()
    {
        return $this->vEmbouteillage;
    }

    /**
     * Set dEmbouteillage
     *
     * @param float $dEmbouteillage
     * @return VolumeDensite
     */
    public function setDEmbouteillage($dEmbouteillage)
    {
        $this->dEmbouteillage = $dEmbouteillage;

        return $this;
    }

    /**
     * Get dEmbouteillage
     *
     * @return float 
     */
    public function getDEmbouteillage()
    {
        return $this->dEmbouteillage;
    }

    /**
     * Set sucreLitre
     *
     * @param integer $sucreLitre
     * @return VolumeDensite
     */
    public function setSucreLitre($sucreLitre)
    {
        $this->sucreLitre = $sucreLitre;

        return $this;
    }

    /**
     * Get sucreLitre
     *
     * @return integer 
     */
    public function getSucreLitre()
    {
        return $this->sucreLitre;
    }


    /**
     * Set brassin
     *
     * @param \Brassin $brassin
     * @return VolumeDensite
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
