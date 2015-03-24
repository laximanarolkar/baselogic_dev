<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\Manufacturers
 *
 * @ORM\Table(name="manufacturers")
 * @ORM\Entity
 */
class Manufacturers
{
    /**
     * @var integer $manId
     *
     * @ORM\Column(name="man_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $manId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string $logo
     *
     * @ORM\Column(name="logo", type="string", length=200, nullable=false)
     */
    private $logo;

    /**
     * @var string $label
     *
     * @ORM\Column(name="label", type="string", length=50, nullable=false)
     */
    private $label;


}