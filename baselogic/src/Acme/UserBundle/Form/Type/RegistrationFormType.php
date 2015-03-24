<?php // src/Acme/UserBundle/Form/Type/RegistrationFormType.php


namespace Acme\UserBundle\Form\Type;

//use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;


use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\NotBlank;

use Acme\UserBundle\Entity\Manufacturers;
class RegistrationFormType extends BaseType
{
   
	public function buildForm(FormBuilder $builder, array $options)
    {

       // parent::buildForm($builder, $options);
	$builder->add('email', 'text', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input')
    
));


$builder->add('password', 'password', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input')
    
));

$builder->add('plain_password', 'password', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input')
    
));

$builder->add('first_name', 'text', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input')
    
));

$builder->add('last_name', 'text', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input')
));

$builder->add('address', 'text', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input','onblank'=>"setCustomValidity('Addres not vald')")
 ));   

$builder->add('phone', 'text', array(
    
        'required'  => true,
        'attr'      => array('class' => 'register_input')

));

     
    }

    public function getName()
    {
        return 'acme_user_registration';
    }
}