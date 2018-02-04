<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maintenance
 *
 * @ORM\Table(name="maintenance")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaintenanceRepository")
 */
class Maintenance
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
     * @ORM\ManyToOne(targetEntity="Asset", inversedBy="maintenance")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     */
    private $asset;

    /**
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="maintenance")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="schedule", type="datetime")
     */
    private $schedule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actual", type="datetime", nullable=true)
     */
    private $actual;


    public function __construct(){
        $this->setSchedule(new \DateTime());
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set provider
     *
     * @param string $provider
     *
     * @return Maintenance
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Maintenance
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set schedule
     *
     * @param \DateTime $schedule
     *
     * @return Maintenance
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return \DateTime
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * Set isdone
     *
     * @param boolean $isdone
     *
     * @return Maintenance
     */
    public function setIsdone($isdone)
    {
        $this->isdone = $isdone;

        return $this;
    }

    /**
     * Get isdone
     *
     * @return bool
     */
    public function getIsdone()
    {
        return $this->isdone;
    }

    /**
     * Set asset
     *
     * @param \AppBundle\Entity\Asset $asset
     *
     * @return Maintenance
     */
    public function setAsset(\AppBundle\Entity\Asset $asset = null)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset
     *
     * @return \AppBundle\Entity\Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * Set vendor
     *
     * @param \AppBundle\Entity\Vendor $vendor
     *
     * @return Maintenance
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
     * Set actual
     *
     * @param \DateTime $actual
     *
     * @return Maintenance
     */
    public function setActual($actual)
    {
        $this->actual = $actual;

        return $this;
    }

    /**
     * Get actual
     *
     * @return \DateTime
     */
    public function getActual()
    {
        return $this->actual;
    }
}