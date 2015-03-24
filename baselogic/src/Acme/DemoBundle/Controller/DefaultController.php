<?php
// src/Acme/DemoBundle/Controller/DefaultController.php


use Acme\DemoBundle\Entity\Products;
use Symfony\Component\HttpFoundation\Response;

public function createAction()
{
    $product = new Products();
    $product->setName('A Foo Bar');
    $product->setPrice('19.99');
    $product->setDescription('Lorem ipsum dolor');

    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($product);
    $em->flush();

    return new Response('Created product id '.$product->getId());
}

public function showAction($id)
{
    $product = $this->getDoctrine()
        ->getRepository('AcmedemoBundle:Products')
        ->find($id);

    if (!$product) {
        throw $this->createNotFoundException('No product found for id '.$id);
    }

    // ... do something, like pass the $product object into a template
}