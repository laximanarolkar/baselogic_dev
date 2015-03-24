<?php
// src/Acme/UserBundle/Entity/User.php

namespace Acme\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 *@UniqueEntity("email")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $cust_id;
	
	
	
	
	  /**
	  @var string $address
     * @ORM\Column(name="address",type="string", length=100)
     *
     * @Assert\NotBlank(message="Please enter your address.", groups={"Registration", "Profile"})
	 * @Assert\Type(type="string")
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="100", message="The first name is too long.", groups={"Registration", "Profile"})
     */
    protected $address;




	/**
	  @var string $phone
     * @ORM\Column(name="phone",type="string", length=100)
     *
     * @Assert\NotBlank(message="Please enter your phone number.", groups={"Registration", "Profile"})
	 * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="100", message="The first name is too long.", groups={"Registration", "Profile"})
     */
	protected $phone;

		  /**
	  @var string $first_name
     * @ORM\Column(name="first_name",type="string", length=100)
     *
 
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="100", message="The first name is too long.", groups={"Registration", "Profile"})
     */
	protected $first_name;
	
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
	  @var string $last_name
     * @ORM\Column(name="last_name",type="string", length=100)
     *
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The last_name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="100", message="The last_name is too long.", groups={"Registration", "Profile"})
     */

    protected $last_name;
	
	  /**
	  @var string $roles
     * @ORM\Column(name="roles",type="string", length=40)
     */

    //protected $roles;

	
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
	
	
		
    public function __construct()
    {
        parent::__construct();
        // your own logic
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
	
	/**
     *
     *
     * @return string
     */
    // public function getRoles()
    // {
        // return $this->roles;
    // }
	/**
     *
     *
     * @return string
     */
    // public function setRoles(array $roles)
    // {
       // $this->roles = $roles;

        // return $this;
    // }
	
	
	
	
}