<?php

namespace Acme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\Styles
 *
 * @ORM\Table(name="styles")
 * @ORM\Entity
 */
class Styles
{
    /**
     * @var integer $styleId
     *
     * @ORM\Column(name="style_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $styleId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var text $label
     *
     * @ORM\Column(name="label", type="text", nullable=false)
     */
    private $label;



    /**
     * Get styleId
     *
     * @return integer 
     */
    public function getStyleId()
    {
        return $this->styleId;
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
     * Set label
     *
     * @param text $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return text 
     */
    public function getLabel()
    {
        return $this->label;
    }
}