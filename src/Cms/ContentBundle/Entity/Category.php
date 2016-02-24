<?php

namespace Cms\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 * @ORM\HasLifecycleCallbacks
 */
class Category {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
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
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     *
     */
    private $data_type;

    /**
     * @ORM\Column(name="supercategory_id",type="integer",nullable=true)
     *
     */
    private $supercategory;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     *
     */
    private $default_sort_type;

    /**
     * @ORM\Column(type="integer", length=1)
     *
     * @Assert\NotBlank
     *
     */
    private $status;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     *  @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $tags;

    /**
     * @ORM\Column(type="integer",nullable=true, name="province_id")
     *
     */
    private $province;

    /**
     * @ORM\Column(type="integer",nullable=true, name="city_id")
     *
     */
    private $city;

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
     * @return Category
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
     * @return Category
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
     * Set dataType
     *
     * @param string $dataType
     *
     * @return Category
     */
    public function setDataType($dataType)
    {
        $this->data_type = $dataType;

        return $this;
    }

    /**
     * Get dataType
     *
     * @return string
     */
    public function getDataType()
    {
        return $this->data_type;
    }

    /**
     * Set supercategory
     *
     * @param integer $supercategory
     *
     * @return Category
     */
    public function setSupercategory($supercategory)
    {
        $this->supercategory = $supercategory;

        return $this;
    }

    /**
     * Get supercategory
     *
     * @return integer
     */
    public function getSupercategory()
    {
        return $this->supercategory;
    }

    /**
     * Set defaultSortType
     *
     * @param string $defaultSortType
     *
     * @return Category
     */
    public function setDefaultSortType($defaultSortType)
    {
        $this->default_sort_type = $defaultSortType;

        return $this;
    }

    /**
     * Get defaultSortType
     *
     * @return string
     */
    public function getDefaultSortType()
    {
        return $this->default_sort_type;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Category
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
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
     * Set tags
     *
     * @param string $tags
     *
     * @return Category
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set province
     *
     * @param integer $province
     *
     * @return Category
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return integer
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set city
     *
     * @param integer $city
     *
     * @return Category
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return integer
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set latelyEdited
     *
     * @param \DateTime $latelyEdited
     *
     * @return Category
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
     * @return Category
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
