<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * flocon
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Flocon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @Groups({"list", "quantite"})
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
     * @var integer
     *
     * @Groups({"list", "quantite"})
     * @ORM\Column(name="quantite", type="float", nullable=true)
     */
    private $quantite;

    /**
     * saveurs du flocon
     *
     * @var \saveurs
     *
     * @ORM\ManyToMany(targetEntity="Saveur", inversedBy="flocons")
     * @ORM\JoinTable(name="saveurs_flocons")
     */
    private $saveurs;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="Empatage", mappedBy="flocon")
     */
    private $empatage;



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
     * @return malt
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
     * Set quantite
     *
     * @param integer $quantite
     * @return malt
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
     * Set saveurs
     *
     * @param \stdClass $saveurs
     * @return malt
     */
    public function setSaveurs($saveurs)
    {
        $this->saveurs = $saveurs;

        return $this;
    }

    /**
     * Get saveurs
     *
     * @return \stdClass 
     */
    public function getSaveurs()
    {
        return $this->saveurs;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return malt
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return malt
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set empatage
     *
     * @param \Empatage $empatage
     * @return Malt
     */
    public function setEmpatage($empatage)
    {
        $this->empatage = $empatage;

        return $this;
    }

    /**
     * Get Empatage
     *
     * @return \Empatage 
     */
    public function getEmpatage()
    {
        return $this->empatage;
    }

    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return strval($this->nom);
        // to show the id of the Category in the select
        // return $this->id;
    }

}
