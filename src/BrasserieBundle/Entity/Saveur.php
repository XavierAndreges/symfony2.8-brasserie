<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * saveur
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Saveur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * 
     * @Groups({"quantite"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"list", "quantite"})
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="Malt", mappedBy="saveurs")
     */
    private $malts;

    /**
     * @ORM\ManyToMany(targetEntity="Flocon", mappedBy="saveurs")
     */
    private $flocons;
    
    /**
     * @ORM\ManyToMany(targetEntity="Houblon", mappedBy="saveurs")
     */
    private $houblons;

   /**
     * Constructor
     *
     * @param Saveur $saveur
     */
    public function __construct(Saveur $saveur = null)
    {
        $this->saveur = $saveur;
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
     * Set nom
     *
     * @param string $nom
     * @return saveur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get malts.
     *
     * @return array
     */
    public function getMalts()
    {
        return $this->malts;
    }

    /**
     * Get flocons.
     *
     * @return array
     */
    public function getFlocons()
    {
        return $this->flocons;
    }


    /**
     * Get houblons.
     *
     * @return array
     */
    public function getHoublons()
    {
        return $this->houblons;
    }


    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->nom;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
