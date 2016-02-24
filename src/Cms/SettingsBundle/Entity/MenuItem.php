<?php

namespace Cms\SettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="menu_items")
 * @ORM\HasLifecycleCallbacks
 */
class MenuItem {

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
     * @ORM\Column(type="integer", name="menu_id")
     *
     * @Assert\NotBlank
     *
     */
    private $menu;

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
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     *
     */
    private $type;

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
    private $url;

    /**
     * @ORM\Column(type="integer", length=1)
     *
     * @Assert\NotBlank
     *
     */
    private $status;

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
     * @return MenuItem
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
     * Set menu
     *
     * @param integer $menu
     *
     * @return MenuItem
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return integer
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MenuItem
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
     * Set type
     *
     * @param integer $type
     *
     * @return MenuItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return MenuItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return MenuItem
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
     * Set latelyEdited
     *
     * @param \DateTime $latelyEdited
     *
     * @return MenuItem
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
     * @return MenuItem
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
