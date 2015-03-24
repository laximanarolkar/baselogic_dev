<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\UserBundle\Entity\Multiplers;
use Acme\UserBundle\Entity\ApplicationBoot;
use Acme\UserBundle\Entity\Manufacturers;
use Symfony\Component\HttpFoundation\Session\Session;

class WelcomeController extends Controller
{
    public function indexAction()
    { echo "test";
	$entityManager = $this->container->get('doctrine')->getEntityManager();
			$ArrManufacturers=$entityManager->getRepository('UserBundle:Manufacturers')->findAll();
			
			
			 return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
		/* $container = ApplicationBoot::getContainer();
$entityManager = $container->get('doctrine')->getEntityManager();
$manufacturer= new Manufacturers($entityManager);
 $result=$entityManager->getRepository('UserBundle:Manufacturers')->findAll();
 print_r($result);
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig'); */
    }
}
