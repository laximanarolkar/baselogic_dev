<?php

namespace Acme\DemoBundle\Entity;

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


}