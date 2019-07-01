<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;
use BrasserieBundle\Entity\BaseIngredientSuperClass;

/**
 * Levure
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Levure
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
     * saveurs du malt
     *
     * @var \saveurs
     * 
     * @Groups({"list", "quantite"})
     *
     * @ORM\ManyToMany(targetEntity="Saveur", inversedBy="malts")
     * @ORM\JoinTable(name="saveurs_levures")
     */
    private $saveurs;

    /**
     * @var string
     *
     * @Groups({"list", "quantite"})
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @Groups({"list", "quantite"})
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var \files
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\ManyToMany(targetEntity="File", inversedBy="malts", cascade={"persist"})
     * @ORM\JoinTable(name="files_levures")
     *
     */
    private $files;

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    /**
     * @var string
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\Column(name="styleDeBiere", type="text", nullable=true)
     */
    private $styleDeBiere;

    /**
     * @Groups({"quantite", "levure"})
     * @MaxDepth(3)
     * @ORM\OneToMany(targetEntity="Brassin", mappedBy="levure")
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
     * set files.
     *
     * @return Malt
     */
    public function setFiles($files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * get files.
     *
     * @return files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * set uploadedFiles.
     *
     * @return Malt
     */
    public function setUploadedFiles($uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;

        return $this;
    }

    /**
     * get uploadedFiles.
     *
     * @return uploadedFiles
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    /**
     * Set styleDeBiere
     *
     * @param string $styleDeBiere
     * @return Levure
     */
    public function setStyleDeBiere($styleDeBiere)
    {
        $this->styleDeBiere = $styleDeBiere;

        return $this;
    }

    /**
     * Get styleDeBiere
     *
     * @return string 
     */
    public function getStyleDeBiere()
    {
        return $this->styleDeBiere;
    }

    /**
     * Set Brassin
     *
     * @param \Brassin $brassin
     * @return Levure
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
