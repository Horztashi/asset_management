<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Brand
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrandRepository")
 */
class Brand
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
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Model", mappedBy="brand")
     */
    private $models;

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
     * @return Brand
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
     * Set models
     *
     * @param \AppBundle\Entity\Model $models
     *
     * @return Brand
     */
    public function setModels(\AppBundle\Entity\Model $models = null)
    {
        $this->models = $models;

        return $this;
    }

    /**
     * Get models
     *
     * @return \AppBundle\Entity\Model
     */
    public function getModels()
    {
        return $this->models;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add model
     *
     * @param \AppBundle\Entity\Model $model
     *
     * @return Brand
     */
    public function addModel(\AppBundle\Entity\Model $model)
    {
        $this->models[] = $model;

        return $this;
    }

    /**
     * Remove model
     *
     * @param \AppBundle\Entity\Model $model
     */
    public function removeModel(\AppBundle\Entity\Model $model)
    {
        $this->models->removeElement($model);
    }
}
