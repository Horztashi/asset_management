<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="google_id", type="string", length=255, nullable=true)
     */
    private $googleId;

    /**
     * @ORM\Column(name="google_access_token", type="string", length=255, nullable=true)
     */
    private $googleAccessToken;

    /**
     * @ORM\Column(name="google_profile_picture", type="string", length=255, nullable=true)
     */
    private $googleProfilePicture;

    /**
     * @var string
     *
     * @ORM\Column(name="employeenumber", type="string", length=25, nullable=true)
     */
    private $employeenumber;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=75, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=75, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="middlename", type="string", length=75, nullable=true)
     */
    private $middlename;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=75, nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="users")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id", nullable=true)
     */
    private $department;

    /**
     * @ORM\ManyToMany(targetEntity="Asset", mappedBy="users")
     */
    private $assets;

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="user")
     */
    private $logs;    

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
     * Set googleId
     *
     * @param string $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set googleAccessToken
     *
     * @param string $googleAccessToken
     *
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }

    /**
     * Get googleAccessToken
     *
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->googleAccessToken;
    }

    /**
     * Set googleProfilePicture
     *
     * @param string $googleProfilePicture
     *
     * @return User
     */
    public function setGoogleProfilePicture($googleProfilePicture)
    {
        $this->googleProfilePicture = $googleProfilePicture;

        return $this;
    }

    /**
     * Get googleProfilePicture
     *
     * @return string
     */
    public function getGoogleProfilePicture()
    {
        return $this->googleProfilePicture;
    }

    /**
     * Set employeenumber
     *
     * @param string $employeenumber
     *
     * @return User
     */
    public function setEmployeenumber($employeenumber)
    {
        $this->employeenumber = $employeenumber;

        return $this;
    }

    /**
     * Get employeenumber
     *
     * @return string
     */
    public function getEmployeenumber()
    {
        return $this->employeenumber;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set middlename
     *
     * @param string $middlename
     *
     * @return User
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename
     *
     * @return string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->lastname . ", " . $this->firstname;
    }

    /**
     * Get formLabel
     *
     * @return string
     */
    public function getFormLabel()
    {
        return $this->getFullname() . " (" . $this->getEmployeenumber() . ")";
    }

    /**
     * Set department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return User
     */
    public function setDepartment(\AppBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \AppBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return User
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add asset
     *
     * @param \AppBundle\Entity\Asset $asset
     *
     * @return User
     */
    public function addAsset(\AppBundle\Entity\Asset $asset)
    {
        $this->assets[] = $asset;
        $asset->addUser($this);
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
        $asset->removeUser($this);
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
