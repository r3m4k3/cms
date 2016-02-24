<?php

namespace Cms\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="newses")
 * @ORM\HasLifecycleCallbacks
 */
class News {

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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $subtitle;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     *
     */
    private $content;

    /**
     * @ORM\Column(type="string", length = 255, nullable = true)
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $initial_content;

    /**
     * @ORM\Column(type="integer", name="category_id")
     *
     * @Assert\NotBlank
     *
     */
    private $category;

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
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $main_photo_id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     */
    private $main_object_in_content_id;

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
     * @ORM\Column(type="integer", length=1)
     *
     * @Assert\NotBlank
     *
     */
    private $forum_enabled;

    /**
     * @ORM\Column(type="integer", length=1)
     *
     * @Assert\NotBlank
     *
     */
    private $social_media_enabled;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     */
    private $hit_counter;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     */
    private $comments_counter;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotBlank
     *
     */
    private $publish_start_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $publish_end_date;

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
        $this->setHitCounter(0);
        $this->setCommentsCounter(0);
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
     * @return News
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
     * Set title
     *
     * @param string $title
     *
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return News
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set initialContent
     *
     * @param string $initialContent
     *
     * @return News
     */
    public function setInitialContent($initialContent)
    {
        $this->initial_content = $initialContent;

        return $this;
    }

    /**
     * Get initialContent
     *
     * @return string
     */
    public function getInitialContent()
    {
        return $this->initial_content;
    }

    /**
     * Set category
     *
     * @param integer $category
     *
     * @return News
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return News
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
     * @return News
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
     * Set mainPhotoId
     *
     * @param integer $mainPhotoId
     *
     * @return News
     */
    public function setMainPhotoId($mainPhotoId)
    {
        $this->main_photo_id = $mainPhotoId;

        return $this;
    }

    /**
     * Get mainPhotoId
     *
     * @return integer
     */
    public function getMainPhotoId()
    {
        return $this->main_photo_id;
    }

    /**
     * Set mainObjectInContentId
     *
     * @param integer $mainObjectInContentId
     *
     * @return News
     */
    public function setMainObjectInContentId($mainObjectInContentId)
    {
        $this->main_object_in_content_id = $mainObjectInContentId;

        return $this;
    }

    /**
     * Get mainObjectInContentId
     *
     * @return integer
     */
    public function getMainObjectInContentId()
    {
        return $this->main_object_in_content_id;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return News
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
     * Set forumEnabled
     *
     * @param integer $forumEnabled
     *
     * @return News
     */
    public function setForumEnabled($forumEnabled)
    {
        $this->forum_enabled = $forumEnabled;

        return $this;
    }

    /**
     * Get forumEnabled
     *
     * @return integer
     */
    public function getForumEnabled()
    {
        return $this->forum_enabled;
    }

    /**
     * Set socialMediaEnabled
     *
     * @param integer $socialMediaEnabled
     *
     * @return News
     */
    public function setSocialMediaEnabled($socialMediaEnabled)
    {
        $this->social_media_enabled = $socialMediaEnabled;

        return $this;
    }

    /**
     * Get socialMediaEnabled
     *
     * @return integer
     */
    public function getSocialMediaEnabled()
    {
        return $this->social_media_enabled;
    }

    /**
     * Set hitCounter
     *
     * @param integer $hitCounter
     *
     * @return News
     */
    public function setHitCounter($hitCounter)
    {
        $this->hit_counter = $hitCounter;

        return $this;
    }

    /**
     * Get hitCounter
     *
     * @return integer
     */
    public function getHitCounter()
    {
        return $this->hit_counter;
    }

    /**
     * Set commentsCounter
     *
     * @param integer $commentsCounter
     *
     * @return News
     */
    public function setCommentsCounter($commentsCounter)
    {
        $this->comments_counter = $commentsCounter;

        return $this;
    }

    /**
     * Get commentsCounter
     *
     * @return integer
     */
    public function getCommentsCounter()
    {
        return $this->comments_counter;
    }

    /**
     * Set publishStartDate
     *
     * @param \DateTime $publishStartDate
     *
     * @return News
     */
    public function setPublishStartDate($publishStartDate)
    {
        $this->publish_start_date = $publishStartDate;

        return $this;
    }

    /**
     * Get publishStartDate
     *
     * @return \DateTime
     */
    public function getPublishStartDate()
    {
        return $this->publish_start_date;
    }

    /**
     * Set publishEndDate
     *
     * @param \DateTime $publishEndDate
     *
     * @return News
     */
    public function setPublishEndDate($publishEndDate)
    {
        $this->publish_end_date = $publishEndDate;

        return $this;
    }

    /**
     * Get publishEndDate
     *
     * @return \DateTime
     */
    public function getPublishEndDate()
    {
        return $this->publish_end_date;
    }

    /**
     * Set latelyEdited
     *
     * @param \DateTime $latelyEdited
     *
     * @return News
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
     * @return News
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
