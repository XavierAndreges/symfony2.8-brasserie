<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;

/**
 * TypeBiere
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TypeBiere
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
     * @var string
     *
     * @Groups({"list"})
     * @ORM\Column(name="nom", type="string", length=255)
     * 
     */
    private $nom;

    /**
     * Brassins du même type
     *
     * @var \Brassins
     *
     * @ORM\OneToMany(targetEntity="Brassin", mappedBy="typeBiere")
     * @MaxDepth(0)
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
     * Set nom
     *
     * @param string $nom
     * @return TypeBiere
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
     * Get brassins.
     *
     * @return brassins
     */
    public function getBrassins()
    {
        return $this->brassins;
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
