<?php

namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Houblon
 
 * @ORM\Table()
 * @ORM\Entity
 */
class Houblon
{
    /**
     * @var integer
     *
     * @Groups({"list"})
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
     * 
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\Column(name="shortName", type="string", length=255)
     */
    private $shortName;

    /**
     * @ORM\OneToMany(targetEntity="Brassin", mappedBy="houblonACru1")
     */
    private $brassinHoublonACru1;

    /**
     * @ORM\OneToMany(targetEntity="Brassin", mappedBy="houblonACru2")
     */
    private $brassinHoublonACru2;

    /**
     * @Groups({"quantite"})
     * 
     * @ORM\OneToMany(targetEntity="Ebulition", mappedBy="houblon")
     */
    private $ebulition;

    /**
     * @var integer
     *
     * @Groups({"quantite"})
     * @ORM\Column(name="quantite", type="float", nullable=true)
     */
    private $quantite;

    /**
     * saveurs du houblon
     *
     * @var \saveurs
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\ManyToMany(targetEntity="Saveur", inversedBy="houblons")
     * @ORM\JoinTable(name="saveurs_houblons")
     */
    private $saveurs;

    /**
     * @var string
     *
     * @Groups({"quantite"})
     * 
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @Groups({"quantite"})
     * 
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var \files
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\ManyToMany(targetEntity="File", inversedBy="malts", cascade={"persist"})
     * @ORM\JoinTable(name="files_houblons")
     *
     */
    private $files;

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    /**
     * @var integer
     *
     * @Groups({"quantite"})
     * @ORM\Column(name="annee", type="integer", nullable=true)
     */
    private $annee;

    /**
     * @var integer
     *
     * @Groups({"quantite"})
     * @ORM\Column(name="acide_alpha", type="float", nullable=true)
     */
    private $acideAlpha;

    /**
     * @var integer
     *
     * @Groups({"quantite"})
     * @ORM\Column(name="bio", type="boolean", options={"default" = false})
     */
    private $bio;

    /**
     * @var integer
     *
     * @Groups({"quantite"})
     * @ORM\Column(name="fonction", type="simple_array", nullable=true)
     */
    private $fonction;

    /**
     * caractères du houblon
     *
     * @var \caracteres
     *
     * @Groups({"list", "quantite"})
     * 
     * @ORM\ManyToMany(targetEntity="Caractere", inversedBy="houblons")
     * @ORM\JoinTable(name="caracteres_houblons")
     */
    private $caracteres;

    /**
     * @var integer
     *
     * @Groups({"quantite"})
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @Groups({"quantite"})
	 * @ORM\ManyToOne(targetEntity="Pays", inversedBy="houblons", cascade={"persist"})
	 * @ORM\JoinColumn(name="Pays_id", referencedColumnName="id")
     */
    private $pays;

    /**
     * houblons similaires
     *
     * @var \houblons
     *
     * @Groups({"quantite"})
     * 
     * @ORM\ManyToMany(targetEntity="Houblon", inversedBy="houblonsSimilaires")
     * @ORM\JoinTable(name="houblonsSimilaires_houblons")
     */
    private $houblonsSimilaires;

























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
     * @return Houblon
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
     * Set shortName
     *
     * @param string $shortName
     * @return Houblon
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }


    /**
     * Set Brassin
     *
     * @param \Brassin $brassinHoublonACru1
     * @return Brassin
     */
    public function setBrassinHoublonACru1($brassinHoublonACru1)
    {
        $this->brassinHoublonACru1 = $brassinHoublonACru1;

        return $this;
    }

    /**
     * Get Brassin
     *
     * @return \Brassin 
     */
    public function getBrassinHoublonACru1()
    {
        return $this->brassinHoublonACru1;
    }


    /**
     * Set Brassin
     *
     * @param \Brassin $brassinHoublonACru2
     * @return Brassin
     */
    public function setBrassinHoublonACru2($brassinHoublonACru2)
    {
        $this->brassinHoublonACru2 = $brassinHoublonACru2;

        return $this;
    }

    /**
     * Get Brassin
     *
     * @return \Brassin 
     */
    public function getBrassinHoublonACru2()
    {
        return $this->brassinHoublonACru2;
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


    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return houblon
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
     * @return houblon
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
     * @return houblon
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
     * @return houblon
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
     * Set annee
     *
     * @param string $annee
     * @return houblon
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set acideAlpha
     *
     * @param string $annee
     * @return houblon
     */
    public function setAcideAlpha($acideAlpha)
    {
        $this->acideAlpha = $acideAlpha;

        return $this;
    }

    /**
     * Get acideAlpha
     *
     * @return string 
     */
    public function getAcideAlpha()
    {
        return $this->acideAlpha;
    }

    /**
     * Set bio
     *
     * @param string $annee
     * @return houblon
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string 
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return houblon
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set caracteres
     *
     * @param \stdClass $caracteres
     * @return houblon
     */
    public function setCaracteres($caracteres)
    {
        $this->caracteres = $caracteres;

        return $this;
    }

    /**
     * Get caracteres
     *
     * @return \stdClass 
     */
    public function getCaracteres()
    {
        return $this->caracteres;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return houblon
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return houblon
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set houblonsSimilaires
     *
     * @param \stdClass $houblonsSimilaires
     * @return houblon
     */
    public function setHoublonsSimilaires($houblonsSimilaires)
    {
        $this->houblonsSimilaires = $houblonsSimilaires;

        return $this;
    }

    /**
     * Get houblonsSimilaires
     *
     * @return \stdClass 
     */
    public function getHoublonsSimilaires()
    {
        return $this->houblonsSimilaires;
    }

}

