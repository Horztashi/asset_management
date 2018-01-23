<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatusRepository")
 */
class Status
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
     * @ORM\OneToMany(targetEntity="Asset", mappedBy="status")
     */
    private $assets;


    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     *
     * @return Status
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
     * Add asset
     *
     * @param \AppBundle\Entity\Asset $asset
     *
     * @return Status
     */
    public function addAsset(\AppBundle\Entity\Asset $asset)
    {
        $this->assets[] = $asset;

        return $this;
    }

    /**
     * Remove asset
     *
     * @param \AppBundle\Entity\Asset $asset
     */
    public function removeAsset(\AppBundle\Entity\Asset $asset)
    {
        $this->assets->removeElement($asset);
    }

    /**
     * Get assets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssets()
    {
        return $this->assets;
    }
}
