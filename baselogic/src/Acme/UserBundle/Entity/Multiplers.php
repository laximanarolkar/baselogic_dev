<?php
// src/Acme/UserBundle/Entity/User.php

namespace Acme\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="multiplers")
 */
class Multiplers 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	 
	 /**
	  @var string $multipler
     * @ORM\Column(name="multipler",type="string", length=100)
     *
     * @Assert\NotBlank(message="Please enter multiplier.", groups={"Registration", "Profile"})
	 * @Assert\Type(type="string")
     * @Assert\MinLength(limit="3", message="The first name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="100", message="The first name is too long.", groups={"Registration", "Profile"})
     */
    protected $multipler;

    /**
     * @ORM\Column(name="man_id",type="integer")
     */
    protected $man_id;
	
	 /**
     * @ORM\Column(name="uid",type="integer")
     */
    protected $uid;

	/**
     * @ORM\Column(name="markup",type="float")
	 *@Assert\NotBlank(message="Please enter markup.", groups={"Registration", "Profile"})
     */
	protected $markup;
	
    /**
     * Get multipler
     *
     * @return string 
     */
    public function getMultipler()
    {
        return $this->multipler;
    }

    /**
     * Set multipler
     *
     * @param string $multipler
     */
    public function setMultipler($multipler)
    {
        $this->multipler = $multipler;
    }
	
	    /**
     * Get man_id
     *
     * @return string 
     */
    public function getManId()
    {
        return $this->man_id;
    }

    /**
     * Set man_id
     *
     * @param string $man_id
     */
    public function setManId($man_id)
    {
        $this->man_id = $man_id;
    }

     /**
     * Get uid
     *
     * @return string 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set uid
     *
     * @param string $uid
     */
    public function setUid($uid)
    {
	//echo "<br>uidddd".$uid;
        $this->uid = $uid;
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
     * Get markup
     *
     * @return string 
     */
    public function getMarkup()
    {
        return $this->markup;
    }

    /**
     * Set markup
     *
     * @param string $markup
     */
    public function setMarkup($markup)
    {
        $this->markup = $markup;
    }

}