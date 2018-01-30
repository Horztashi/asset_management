<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 *
 * @ORM\Table(name="asset")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="assets")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
    */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="assets")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="ponumber", type="string", length = 55)
     */
    private $ponumber;

    /**
     * @var number
     *
     * @ORM\Column(name="price", type="decimal", scale = 2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturerserial", type="string", length = 55)
     */
    private $manufacturerserial;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="warrantystart", type="datetime")
     */
    private $warrantystart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="warrantyend", type="datetime")
     */
    private $warrantyend;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchasedate", type="datetime")
     */
    private $purchasedate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="servicedate", type="datetime")
     */
    private $servicedate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="iscritical", type="boolean")
     */
    private $isCritical;


    /**
     * @ORM\ManyToOne(targetEntity="Model", inversedBy="assets")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="assets")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="assets")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="asset")
     */
    private $logs;

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
     * Set name
     *
     * @param string $name
     *
     * @return Asset
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set room
     *
     * @param \AppBundle\Entity\Room $room
     *
     * @return Asset
     */
    public function setRoom(\AppBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \AppBundle\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Asset
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     *
     * @return Asset
     */
    public function setStatus(\AppBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->logs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add log
     *
     * @param \AppBundle\Entity\Log $log
     *
     * @return Asset
     */
    public function addLog(\AppBundle\Entity\Log $log)
    {
        $this->logs[] = $log;

        return $this;
    }

    /**
     * Remove log
     *
     * @param \AppBundle\Entity\Log $log
     */
    public function removeLog(\AppBundle\Entity\Log $log)
    {
        $this->logs->removeElement($log);
    }

    /**
     * Get logs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Set serialnumber
     *
     * @param string $serialnumber
     *
     * @return Asset
     */
    public function setSerialnumber($serialnumber)
    {
        $this->serialnumber = $serialnumber;

        return $this;
    }

    /**
     * Get serialnumber
     *
     * @return string
     */
    public function getSerialnumber()
    {
        return $this->serialnumber;
    }

    /**
     * Set ponumber
     *
     * @param string $ponumber
     *
     * @return Asset
     */
    public function setPonumber($ponumber)
    {
        $this->ponumber = $ponumber;

        return $this;
    }

    /**
     * Get ponumber
     *
     * @return string
     */
    public function getPonumber()
    {
        return $this->ponumber;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Asset
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set manufacturerserial
     *
     * @param string $manufacturerserial
     *
     * @return Asset
     */
    public function setManufacturerserial($manufacturerserial)
    {
        $this->manufacturerserial = $manufacturerserial;

        return $this;
    }

    /**
     * Get manufacturerserial
     *
     * @return string
     */
    public function getManufacturerserial()
    {
        return $this->manufacturerserial;
    }

    /**
     * Set warrantystart
     *
     * @param \DateTime $warrantystart
     *
     * @return Asset
     */
    public function setWarrantystart($warrantystart)
    {
        $this->warrantystart = $warrantystart;

        return $this;
    }

    /**
     * Get warrantystart
     *
     * @return \DateTime
     */
    public function getWarrantystart()
    {
        return $this->warrantystart;
    }

    /**
     * Set warrantyend
     *
     * @param \DateTime $warrantyend
     *
     * @return Asset
     */
    public function setWarrantyend($warrantyend)
    {
        $this->warrantyend = $warrantyend;

        return $this;
    }

    /**
     * Get warrantyend
     *
     * @return \DateTime
     */
    public function getWarrantyend()
    {
        return $this->warrantyend;
    }

    /**
     * Set purchasedate
     *
     * @param \DateTime $purchasedate
     *
     * @return Asset
     */
    public function setPurchasedate($purchasedate)
    {
        $this->purchasedate = $purchasedate;

        return $this;
    }

    /**
     * Get purchasedate
     *
     * @return \DateTime
     */
    public function getPurchasedate()
    {
        return $this->purchasedate;
    }

    /**
     * Set servicedate
     *
     * @param \DateTime $servicedate
     *
     * @return Asset
     */
    public function setServicedate($servicedate)
    {
        $this->servicedate = $servicedate;

        return $this;
    }

    /**
     * Get servicedate
     *
     * @return \DateTime
     */
    public function getServicedate()
    {
        return $this->servicedate;
    }

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return Asset
     */
    public function setLocation(\AppBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set vendor
     *
     * @param \AppBundle\Entity\Vendor $vendor
     *
     * @return Asset
     */
    public function setVendor(\AppBundle\Entity\Vendor $vendor = null)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \AppBundle\Entity\Vendor
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set model
     *
     * @param \AppBundle\Entity\Model $model
     *
     * @return Asset
     */
    public function setModel(\AppBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \AppBundle\Entity\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Asset
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isCritical
     *
     * @param boolean $isCritical
     *
     * @return Asset
     */
    public function setIsCritical($isCritical)
    {
        $this->isCritical = $isCritical;

        return $this;
    }

    /**
     * Get isCritical
     *
     * @return boolean
     */
    public function getIsCritical()
    {
        return $this->isCritical;
    }
}
