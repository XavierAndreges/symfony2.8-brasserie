<?php
namespace BrasserieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * Brassin
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BrasserieBundle\Entity\BrassinRepository")
 */
class Brassin
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
     * @var string
     *
     * @Groups({"list"})
     * @ORM\Column(name="lot", type="string", length=255, nullable=true, unique=true)
     */
    private $lot;

    /**
     * @var \stdClass
     * @MaxDepth(1)
     * @Groups({"list"})
     * @ORM\ManyToOne(targetEntity="TypeBiere", inversedBy="brassin", cascade={"persist"}))
     * @ORM\JoinColumn(name="TypeBiere_id", referencedColumnName="id")
     */
    private $typeBiere;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="totalGrain", type="float", nullable=true)
     */
    private $totalGrain;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="ibu", type="integer", nullable=true)
     */
    private $ibu;

    /**
     * @var float
     *
     * @Groups({"list"})
     * @ORM\Column(name="alcool", type="float", nullable=true)
     */
    private $alcool;

    /**
     * @var boolean
     *
     * @Groups({"list"})
     * @ORM\Column(name="vendable", type="boolean", options={"default" = false})
     */
    private $vendable;

    /**
     * @var integer
     *
     * @Groups({"list"})
     * @ORM\Column(name="trop_de_mousse", type="integer", options={"default" = 0})
     */
    private $tropDeMousse;

	/**
     * @Groups({"list"})
	 * @ORM\OneToOne(targetEntity="Date", inversedBy="brassin", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(name="Date_id", referencedColumnName="id")
	 */
	private $date;

    /**
     * @Groups({"list", "quantite"})
	 * @ORM\OneToOne(targetEntity="VolumeDensite", inversedBy="brassin", cascade={"persist"})
	 * @ORM\JoinColumn(name="VolumeDensite_id", referencedColumnName="id")
	 */
    private $volumeDensite;
    
    /**
     * @Groups({"list"})
	 * @ORM\OneToOne(targetEntity="Embouteillage", inversedBy="brassin", cascade={"persist", "merge", "remove"})
	 * @ORM\JoinColumn(name="Embouteillage_id", referencedColumnName="id")
	 */
    private $embouteillage;
    
    /**
     * @MaxDepth(1)
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Levure", inversedBy="brassin", cascade={"persist"})
	 * @ORM\JoinColumn(name="Levure_id", referencedColumnName="id")
	 */
    private $levure;

    /**
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Houblon", inversedBy="brassinHoublonACru1", cascade={"persist"})
	 * @ORM\JoinColumn(name="HoublonACru1_id", referencedColumnName="id")
	 */
    private $houblonACru1;

    /**
     * @Groups({"list"})
	 * @ORM\ManyToOne(targetEntity="Houblon", inversedBy="brassinHoublonACru2", cascade={"persist"})
	 * @ORM\JoinColumn(name="HoublonACru2_id", referencedColumnName="id")
	 */
    private $houblonACru2;

    /**
     *
     * @MaxDepth(3)
     * @Groups({"list"})
     * @ORM\ManyToMany(targetEntity="Empatage", inversedBy="brassins", cascade="all", orphanRemoval=true)
     * @ORM\JoinTable(name="empatages_brassins")
     */
    private $empatages;

    /**
     * @MaxDepth(1)
     * @Groups({"list"})
	 * @ORM\ManyToMany(targetEntity="Ebulition", inversedBy="brassins", cascade="all", orphanRemoval=true)
	 * @ORM\JoinTable(name="Ebulitions_brassins")
	 */
    public $ebulitions;

    /**
     * @var string
     *
     * @Groups({"list"})
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;


    public function __construct()
    {
       $this->empatages = new ArrayCollection();
       $this->ebulitions = new ArrayCollection();
    }


    /**
	 * @param $ebulition
	 */
    public function addEbulition(Ebulition $ebulition)
    {
        $ebulition->addBrassin($this);
        $this->ebulitions[] = $ebulition;
    }

    /**
	 * @return Ebulitions
	 */
	public function getEbulitions()
	{
		return $this->ebulitions;
    }

    /**
	 * @param $empatage
	 */
	public function addEmpatage(Empatage $empatage)
	{
        $empatage->addBrassin($this);
        $this->empatages[] = $empatage;
        
        //*** dans le cas OneToMany *****/
        //$empatage->setBrassin($this);

        return $this;
    }
    
    /**
     * Remove empatage.
     *
     */
    public function removeEmpatage(Empatage $empatage)
    {
        $this->empatages->removeElement($empatage);
    }
     
    
	/**
	 * @return Empatages
	 */
	public function getEmpatages()
	{
		return $this->empatages;
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return Brassin
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
     * Set lot
     *
     * @param integer $lot
     * @return Brassin
     */
    public function setLot($lot)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * Get lot
     *
     * @return integer 
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Set typeBiere
     *
     * @param \stdClass $typeBiere
     * @return Brassin
     */
    public function setTypeBiere($typeBiere)
    {
        $this->typeBiere = $typeBiere;

        return $this;
    }

    /**
     * Get typeBiere
     *
     * @return \stdClass 
     */
    public function getTypeBiere()
    {
        return $this->typeBiere;
    }

    /**
     * Set totalGrain
     *
     * @param integer $totalGrain
     * @return Brassin
     */
    public function setTotalGrain($totalGrain)
    {
        $this->totalGrain = $totalGrain;

        return $this;
    }

    /**
     * Get totalGrain
     *
     * @return integer 
     */
    public function getTotalGrain()
    {
        return $this->totalGrain;
    }

    /**
     * Set ibu
     *
     * @param integer $ibu
     * @return Brassin
     */
    public function setIbu($ibu)
    {
        $this->ibu = $ibu;

        return $this;
    }

    /**
     * Get ibu
     *
     * @return integer 
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * Set alcool
     *
     * @param integer $alcool
     * @return Brassin
     */
    public function setAlcool($alcool)
    {
        $this->alcool = $alcool;

        return $this;
    }

    /**
     * Get alcool
     *
     * @return integer 
     */
    public function getAlcool()
    {
        return $this->alcool;
    }

    /**
     * Set vendable
     *
     * @param integer $vendable
     * @return Brassin
     */
    public function setVendable($vendable)
    {
        $this->vendable = $vendable;

        return $this;
    }

    /**
     * Get vendable
     *
     * @return integer 
     */
    public function getVendable()
    {
        return $this->vendable;
    }

    /**
     * set tropDeMousse
     *
     * @param integer $tropDeMousse
     * @return Brassin 
     */
    public function setTropDeMousse($tropDeMousse)
    {
        $this->tropDeMousse = $tropDeMousse;

        return $this;
    }

    /**
     * Get tropDeMousse
     *
     * @return integer 
     */
    public function getTropDeMousse()
    {
        return $this->tropDeMousse;
    }


    /**
	 * @param $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}
	 
	/**
	 * @return Brassin
	 */
	public function getDate()
	{
		return $this->date;
    }
    
    /**
	 * @param $volumeDensite
	 */
	public function setVolumeDensite($volumeDensite)
	{
		$this->volumeDensite = $volumeDensite;
	}
	 
	/**
	 * @return VolumeDensite
	 */
	public function getVolumeDensite()
	{
		return $this->volumeDensite;
    }

    /**
	 * @param $embouteillage
	 */
	public function setEmbouteillage($embouteillage)
	{
		$this->embouteillage = $embouteillage;
	}
	 
	/**
	 * @return Embouteillage
	 */
	public function getEmbouteillage()
	{
		return $this->embouteillage;
    }


    /**
	 * @param $levure
	 */
	public function setLevure($levure)
	{
		$this->levure = $levure;
	}
	 
	/**
	 * @return Levure
	 */
	public function getLevure()
	{
		return $this->levure;
    }

    /**
	 * @param $houblonACru1
	 */
	public function setHoublonACru1($houblonACru1)
	{
		$this->houblonACru1 = $houblonACru1;
	}
	 
	/**
	 * @return Houblon
	 */
	public function getHoublonACru1()
	{
		return $this->houblonACru1;
    }

    /**
	 * @param $houblonACru2
	 */
	public function setHoublonACru2($houblonACru2)
	{
		$this->houblonACru2 = $houblonACru2;
	}
	 
	/**
	 * @return Houblon
	 */
	public function getHoublonACru2()
	{
		return $this->houblonACru2;
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
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return strval($this->lot);
        // to show the id of the Category in the select
        // return $this->id;
    }
    
}
