<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model
 *
 * @ORM\Table(name="model")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModelRepository")
 */
class Model
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
     * @ORM\Column(name="name", type="string", length=75)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="models")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    private $brand;

    /**
     * @ORM\OneToMany(targetEntity="Asset", mappedBy="model")
     */
    private $assets;

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
     * @return Model
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
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return Model
     */
    public function setBrand(\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add asset
     *
     * @param \AppBundle\Entity\Asset $asset
     *
     * @return Model
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
