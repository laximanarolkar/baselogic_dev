<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\Products
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Products
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float $price
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $prod_name
     *
     * @ORM\Column(name="prod_name", type="string", length=255)
     */
    private $prod_name;

    /**
     * @var float $prod_price
     *
     * @ORM\Column(name="prod_price", type="float")
     */
    private $prod_price;

    /**
     * @var text $prod_desc
     *
     * @ORM\Column(name="prod_desc", type="text")
     */
    private $prod_desc;


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
     * Set price
     *
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prod_name
     *
     * @param string $prodName
     */
    public function setProdName($prodName)
    {
        $this->prod_name = $prodName;
    }

    /**
     * Get prod_name
     *
     * @return string 
     */
    public function getProdName()
    {
        return $this->prod_name;
    }

    /**
     * Set prod_price
     *
     * @param float $prodPrice
     */
    public function setProdPrice($prodPrice)
    {
        $this->prod_price = $prodPrice;
    }

    /**
     * Get prod_price
     *
     * @return float 
     */
    public function getProdPrice()
    {
        return $this->prod_price;
    }

    /**
     * Set prod_desc
     *
     * @param text $prodDesc
     */
    public function setProdDesc($prodDesc)
    {
        $this->prod_desc = $prodDesc;
    }

    /**
     * Get prod_desc
     *
     * @return text 
     */
    public function getProdDesc()
    {
        return $this->prod_desc;
    }
}