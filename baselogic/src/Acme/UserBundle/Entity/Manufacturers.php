<?php 
// src/Acme/UserBundle/Entity/manufacturers.php
namespace Acme\UserBundle\Entity;

use Symfony\Component\DependencyInjection\ContainerAware as ca;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as main;
use Doctrine\ORM\EntityRepository;
use Acme\UserBundle\Entity\ApplicationBoot;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Acme\UserBundle\Repository\ManufacturerRepository")
 * @ORM\Table(name="manufacturers")
 */
 

class Manufacturers extends main
{


 protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
	
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $man_id;

    /**
     * @ORM\Column(name="name",type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="logo",type="string", length=200)
     */
    protected $logo;

    /**
     * @ORM\Column(name="label",type="string", length=50)
     */
    protected $label;

    /**
     * Get man_id
     *
     * @return integer 
     */
    public function getManId()
    {
        return $this->man_id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set logo
     *
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }
	
	public function fetchAllManufacturer()
	{ 
	return	 $this->getEntityManager()->getRepository('UserBundle:Manufacturers')->findAll();

	}

    
	public function fetchManufacturerById($id)
	{ 
	return	 $this->getEntityManager()->getRepository('UserBundle:Manufacturers')->find($id);

	}		
	
	public function getEntityManager()
	{
	return $this->em;
	}
	
	 
	
	
    
}