<?php

namespace Cms\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="cities")
 * @ORM\HasLifecycleCallbacks
 */
class City {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $slug;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     */
    private $province_id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $lately_edited;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime", name="created")
     *
     */
    private $created;

    public function __construct() {
        $this->setCreated(new \DateTime());
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return City
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
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
     * Set slug
     *
     * @param string $slug
     *
     * @return City
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set provinceId
     *
     * @param integer $provinceId
     *
     * @return City
     */
    public function setProvinceId($provinceId)
    {
        $this->province_id = $provinceId;

        return $this;
    }

    /**
     * Get provinceId
     *
     * @return integer
     */
    public function getProvinceId()
    {
        return $this->province_id;
    }

    /**
     * Set latelyEdited
     *
     * @param \DateTime $latelyEdited
     *
     * @return City
     */
    public function setLatelyEdited($latelyEdited)
    {
        $this->lately_edited = $latelyEdited;

        return $this;
    }

    /**
     * Get latelyEdited
     *
     * @return \DateTime
     */
    public function getLatelyEdited()
    {
        return $this->lately_edited;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return City
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
