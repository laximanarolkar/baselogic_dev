<?php
// src/Acme/UserBundle/Form/Handler/RegistrationFormHandler.php
namespace Acme\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;
use Acme\UserBundle\Entity\Multiplers;
use Acme\UserBundle\Entity\Manufacturers;
use Acme\UserBundle\Entity\ApplicationBoot;
class RegistrationFormHandler extends BaseHandler
{ 
  public function process($confirmation = false)
    { 
        $user = $this->userManager->createUser();

        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) { 
            $this->form->bindRequest($this->request);

			
            if ($this->form->isValid()) {
			$user->addRole('dealer');
                $this->onSuccess($user, $confirmation);
				
			/* start----make entries in the multiplers table*/
				$container = ApplicationBoot::getContainer();
$entityManager = $container->get('doctrine')->getEntityManager();
$manufacturer= new Manufacturers($entityManager);
 $result=$entityManager->getRepository('UserBundle:Manufacturers')->findAll();

	foreach($result as $result_values)
	{
		if(isset($_POST[$result_values->getManId()] ) && $_POST[$result_values->getManId()]!='')
		{
		
		$cid=$user->getCustId();
		

			$multiplers = new Multiplers;
			$multiplers->setMultipler($_POST[$result_values->getManId()]);
			$multiplers->setManId($result_values->getManId()); 
			$multiplers->setUid($cid);
			$multiplers->setMarkup($_POST['markup'.$result_values->getManId()]);

	
		$entityManager->persist($multiplers);
		$entityManager->flush();

		}
	}
              return true;
            }
				else 
				return false;/* end--make entries in the multiplers table*/
			
			
        }

        return false;
    }

  protected function onSuccess(UserInterface $user, $confirmation)
    { 
        if ($confirmation) {
            $user->setEnabled(false);
            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
            $user->setConfirmationToken(null);
            $user->setEnabled(true);
        }
		
        $this->userManager->updateUser($user);
    }
	
	//user registration
	 public function processUser($confirmation = false)
    { 
	
	
        $user = $this->userManager->createUser();

        $this->form->setData($user);
        
        if ('POST' === $this->request->getMethod()) { 
		$this->form->bindRequest($this->request);
	
		//echo "usrrr".$this->form["email"]->getData();;
		
		
	
				$user->addRole('user');
				$mailPost=$this->form["email"]->getData();
				$fName=$this->form["first_name"]->getData();
				$lName=$this->form["last_name"]->getData();
				$addr=$this->form["address"]->getData();
				$phne=$this->form["phone"]->getData();
					
				$container = ApplicationBoot::getContainer();
				
				$entityManager = $container->get('doctrine')->getEntityManager();
				$userMail=$entityManager->getRepository('UserBundle:Customerdb')->findOneByEmail($mailPost);

						// echo "mail posted:".$mailPost;
						// echo "<pre>";
						// print_r($userMail);

				
				 
					if(count($userMail)==0) {
						// echo "in if";
						// echo "<pre>";
						// print_r($userMail);
						
						
				$this->onSuccessUser($user, $confirmation);
					}
					else{
					// echo "in else";

						 $user->addRole('user');
							$userMail->setFirstName($fName);
							$userMail->setLastName($lName);
							$userMail->setAddress($addr);
							$userMail->setPhone($phne);
							
							
							
							echo $userMail->getFirstName();
							echo $userMail->getLastName();
							echo $userMail->getAddress();
							echo $userMail->getPhone();
							
						$entityManager->flush(); 
					
					
					} 
				
					
			
			
        }

        return false;
    }

  protected function onSuccessUser(UserInterface $user, $confirmation)
    { 
        if ($confirmation) {
           // $user->setEnabled(false);
            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
            $user->setConfirmationToken(null);
            $user->setEnabled(true);
        }
	
        $this->userManager->updateUser($user);
    }
	
	
	
}