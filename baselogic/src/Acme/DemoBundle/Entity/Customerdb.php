<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\Customerdb
 *
 * @ORM\Table(name="customerdb")
 * @ORM\Entity
 */
class Customerdb
{
    /**
     * @var integer $customerid
     *
     * @ORM\Column(name="CustomerID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $customerid;

    /**
     * @var string $fname
     *
     * @ORM\Column(name="Fname", type="string", length=40, nullable=false)
     */
    private $fname;

    /**
     * @var string $custusername
     *
     * @ORM\Column(name="custUsername", type="string", length=120, nullable=false)
     */
    private $custusername;

    /**
     * @var string $usernameCanonical
     *
     * @ORM\Column(name="username_canonical", type="string", length=120, nullable=false)
     */
    private $usernameCanonical;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=120, nullable=false)
     */
    private $email;

    /**
     * @var string $emailCanonical
     *
     * @ORM\Column(name="email_canonical", type="string", length=120, nullable=false)
     */
    private $emailCanonical;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=120, nullable=false)
     */
    private $salt;

    /**
     * @var string $custpass
     *
     * @ORM\Column(name="custPass", type="string", length=120, nullable=false)
     */
    private $custpass;

    /**
     * @var datetime $lastLogin
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=false)
     */
    private $lastLogin;

    /**
     * @var string $confirmationToken
     *
     * @ORM\Column(name="confirmation_token", type="string", length=120, nullable=false)
     */
    private $confirmationToken;

    /**
     * @var datetime $passwordRequestedAt
     *
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=false)
     */
    private $passwordRequestedAt;


}