<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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


}