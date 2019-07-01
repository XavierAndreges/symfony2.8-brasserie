<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * Epice
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Epice
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="Ebulition", mappedBy="houblon")
     */
    private $ebulition;



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
     * @return Epice
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
     * @return Epice
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
     * Set description
     *
     * @param string $description
     * @return Epice
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
     * @return Epice
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
     * Set ebulition
     *
     * @param \Ebulition $ebulition
     * @return Houblon
     */
    public function setEbulition($ebulition)
    {
        $this->ebulition = $ebulition;

        return $this;
    }

    /**
     * Get Ebulition
     *
     * @return \Ebulition 
     */
    public function getEbulition()
    {
        return $this->ebulition;
    }

}
