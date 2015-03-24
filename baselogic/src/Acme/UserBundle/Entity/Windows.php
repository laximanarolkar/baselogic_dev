<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Acme\UserBundle\Entity\Manufacturer;
use Acme\UserBundle\Entity\ApplicationBoot;
/**
 * Acme\DemoBundle\Entity\Windows
 *
 * @ORM\Table(name="windows")
 * @ORM\Entity
 */
class Windows
{



    /**
     * @var float $id
     *
     * @ORM\Column(name="id", type="float", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $manufacturer
     *
     * @ORM\Column(name="manufacturer", type="string", length=255, nullable=true)
     */
    private $manufacturer;

    /**
     * @var string $line
     *
     * @ORM\Column(name="line", type="string", length=255, nullable=true)
     */
    private $line;

    /**
     * @var string $frame
     *
     * @ORM\Column(name="frame", type="string", length=255, nullable=true)
     */
    private $frame;

    /**
     * @var float $width
     *
     * @ORM\Column(name="width", type="float", nullable=true)
     */
    private $width;

    /**
     * @var float $height
     *
     * @ORM\Column(name="height", type="float", nullable=true)
     */
    private $height;

    /**
     * @var string $callout
     *
     * @ORM\Column(name="callout", type="string", length=255, nullable=true)
     */
    private $callout;

    /**
     * @var string $ui
     *
     * @ORM\Column(name="ui", type="string", length=255, nullable=true)
     */
    private $ui;

    /**
     * @var float $base
     *
     * @ORM\Column(name="base", type="float", nullable=true)
     */
    private $base;

    /**
     * @var float $lowe
     *
     * @ORM\Column(name="lowe", type="float", nullable=true)
     */
    private $lowe;

    /**
     * @var float $tempered
     *
     * @ORM\Column(name="tempered", type="float", nullable=true)
     */
    private $tempered;

    /**
     * @var float $obscure
     *
     * @ORM\Column(name="obscure", type="float", nullable=true)
     */
    private $obscure;

    /**
     * @var float $flat
     *
     * @ORM\Column(name="flat", type="float", nullable=true)
     */
    private $flat;

    /**
     * @var float $sculptured
     *
     * @ORM\Column(name="sculptured", type="float", nullable=true)
     */
    private $sculptured;

    /**
     * @var float $argon
     *
     * @ORM\Column(name="argon", type="float", nullable=true)
     */
    private $argon;

    /**
     * @var string $style
     *
     * @ORM\Column(name="style", type="string", length=255, nullable=true)
     */
    private $style;

    /**
     * @var string $material
     *
     * @ORM\Column(name="material", type="string", length=255, nullable=true)
     */
    private $material;


	
	  /**
     * Set label
     *
     * @param string $label
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
	   public function getId()
    {
        return $this->id;
    }
	
	   public function getLine()
    {
        return $this->line;
    }
	
	   public function getFrame()
    {
        return $this->frame;
    }
	
	   public function getWidth()
    {
        return $this->width;
    }
	
	   public function getHeight()
    {
        return $this->height;
    }
	
	   public function getCallout()
    {
        return $this->callout;
    }
	 public function getUi()
    {
        return $this->ui;
    }
	 public function getLowe()
    {
        return $this->lowe;
    }
	
	 public function getBase()
    {
        return $this->base;
    }
	 public function getTempered()
    {
        return $this->tempered;
    }
	
	 public function getObscure()
    {
        return $this->obscure;
    }
	
	 public function getFlat()
    {
        return $this->flat;
    }
	
	 public function getSculptured()
    {
        return $this->sculptured;
    }
	
	 public function getArgon()
    {
        return $this->argon;
    }
	
	 public function getStyle()
    {
        return $this->style;
    }
	
	 public function getMaterial()
    {
        return $this->material;
    }
	 

}