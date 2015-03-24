<?php
// src/Acme/UserBundle/Entity/User.php

namespace Acme\UserBundle\Entity;


// use Acme\UserBundle\Entity\Customerdb_User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 *@UniqueEntity("email")
 */
class Customerdb 
{

  
	   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $cust_id;
	

	

	  /**
	  @var string $first_name
     * @ORM\Column(name="first_name",type="string", length=40)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="40", message="The first name is too long.", groups={"Registration", "Profile"})
     */

    protected $first_name;
	
	
	
	  /**
	  @var string $roles
     * @ORM\Column(name="roles",type="string", length=40)
     */

   protected $roles;

	
	
	/**
     *
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }
	/**
     *
     *
     * @return string
     */
    public function setFirstName($first_name)
    {
       $this->first_name = $first_name;

        return $this;
    }
	
	
		/**
     * Get cust_id
     *
     * @return integer 
     */
    public function getCustId()
    {
        return $this->cust_id;
    }
	
	
	
	
	

	  /**
	  @var string $last name
     * @ORM\Column(name="last_name",type="string", length=40)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="40", message="The first name is too long.", groups={"Registration", "Profile"})
     */

    protected $last_name;
	
	/**
     *
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
	/**
     *
     *
     * @return string
     */
    public function setLastName($last_name)
    {
       $this->last_name = $last_name;

        return $this;
    }
	
	
	
	
	  /**
	  @var string $address
     * @ORM\Column(name="address",type="string", length=40)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="40", message="The first name is too long.", groups={"Registration", "Profile"})
     */

    protected $address;
	
	/**
     *
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
	/**
     *
     *
     * @return string
     */
    public function setAddress($address)
    {
       $this->address = $address;

        return $this;
    }
	
	
	
	  /**
	  @var string $phone
     * @ORM\Column(name="phone",type="string", length=40)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="40", message="The first name is too long.", groups={"Registration", "Profile"})
     */

    protected $phone;
	
	/**
     *
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
	/**
     *
     *
     * @return string
     */
    public function setPhone($phone)
    {
       $this->phone = $phone;

        return $this;
    }
	
	

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    /**
     * @var integer $customerid
     */
    private $customerid;

    /**
     * @var string $custusername
     */
    private $custusername;

    /**
     * @var string $usernameCanonical
	 * @ORM\Column(name="username_canonical",type="string", length=40, unique=true)
     */
    private $usernameCanonical;

   	  /**
	  @var string $email
     * @ORM\Column(name="email",type="string", length=40, unique=true)
     * 
     */
    private $email;

    /**
     * @var string $emailCanonical
     */
    private $emailCanonical;

    /**
     * @var boolean $enabled
     */
    private $enabled;

    /**
     * @var string $salt
     */
    private $salt;

    /**
     * @var string $custpass
     */
    private $custpass;

    /**
     * @var datetime $lastLogin
     */
    private $lastLogin;

    /**
     * @var string $confirmationToken
     */
    private $confirmationToken;

    /**
     * @var datetime $passwordRequestedAt
     */
    private $passwordRequestedAt;


    /**
     * Get customerid
     *
     * @return integer 
     */
    public function getCustomerid()
    {
        return $this->customerid;
    }

    /**
     * Set custusername
     *
     * @param string $custusername
     */
    public function setCustusername($custusername)
    {
        $this->custusername = $custusername;
    }

    /**
     * Get custusername
     *
     * @return string 
     */
    public function getCustusername()
    {
        return $this->custusername;
    }

    /**
     * Set usernameCanonical
     *
     * @param string $usernameCanonical
     */
    public function setUsernameCanonical($usernameCanonical)
    {
        $this->usernameCanonical = $usernameCanonical;
    }

    /**
     * Get usernameCanonical
     *
     * @return string 
     */
    public function getUsernameCanonical()
    {
        return $this->usernameCanonical;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Set emailCanonical
     *
     * @param string $emailCanonical
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;
    }

    /**
     * Get emailCanonical
     *
     * @return string 
     */
    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set custpass
     *
     * @param string $custpass
     */
    public function setCustpass($custpass)
    {
        $this->custpass = $custpass;
    }

    /**
     * Get custpass
     *
     * @return string 
     */
    public function getCustpass()
    {
        return $this->custpass;
    }

    /**
     * Set lastLogin
     *
     * @param datetime $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * Get lastLogin
     *
     * @return datetime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * Get confirmationToken
     *
     * @return string 
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set passwordRequestedAt
     *
     * @param datetime $passwordRequestedAt
     */
    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;
    }

    /**
     * Get passwordRequestedAt
     *
     * @return datetime 
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }
	
	
 	/**
     *
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }
	/**
     *
     *
     * @return string
     */
    public function setRoles(array $roles)
    {
       $this->roles = $roles;

        return $this;
    }
	 
	
	
	
	
	
	
	
	
	
	
	
	
	
}