<?php

namespace Cms\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity("username",message="Taki login istnieje już w bazie danych.")
 * @UniqueEntity("email",message="Taki adres e-mail istnieje już w bazie danych.")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $firstname;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     *
     */
    protected $password;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank
     *
     * @Assert\Email()
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     *
     */
    private $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Length(
     *      max = "255"
     * )
     *
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *
     */
    private $ip;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $auth_key;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $role;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $activated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $last_login_date;

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
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Users
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
     * @return Users
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
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Users
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Users
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Users
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Users
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set auth_key
     *
     * @param string $authKey
     * @return Users
     */
    public function setAuthKey($authKey)
    {
        $this->auth_key = $authKey;

        return $this;
    }

    /**
     * Get auth_key
     *
     * @return string 
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Set last_login_date
     *
     * @param \DateTime $lastLoginDate
     * @return Users
     */
    public function setLastLoginDate($lastLoginDate)
    {
        $this->last_login_date = $lastLoginDate;

        return $this;
    }

    /**
     * Get last_login_date
     *
     * @return \DateTime 
     */
    public function getLastLoginDate()
    {
        return $this->last_login_date;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Users
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

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return array($this->role);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Set activated
     *
     * @param \DateTime $activated
     * @return Users
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Get activated
     *
     * @return \DateTime 
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }
}
