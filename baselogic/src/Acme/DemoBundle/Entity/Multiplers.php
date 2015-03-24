<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\Multiplers
 *
 * @ORM\Table(name="multiplers")
 * @ORM\Entity
 */
class Multiplers
{
    /**
     * @var integer $uid
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var float $multipler
     *
     * @ORM\Column(name="multipler", type="float", nullable=false)
     */
    private $multipler;

    /**
     * @var integer $manId
     *
     * @ORM\Column(name="man_id", type="integer", nullable=false)
     */
    private $manId;


}