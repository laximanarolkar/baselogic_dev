<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\CustomerOld
 *
 * @ORM\Table(name="customer_old")
 * @ORM\Entity
 */
class CustomerOld
{
    /**
     * @var integer $custId
     *
     * @ORM\Column(name="cust_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $custId;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string $passwd
     *
     * @ORM\Column(name="passwd", type="string", length=100, nullable=false)
     */
    private $passwd;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     */
    private $lastName;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     */
    private $firstName;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;


}