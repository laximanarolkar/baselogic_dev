<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

  
 
namespace Acme\UserBundle\Controller;

 
require_once ($_SERVER['DOCUMENT_ROOT'].'/app/src/Acme/UserBundle/Controller/EpiTwitter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/app/src/Acme/UserBundle/Controller/twitter_includes/EpiCurl.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/app/src/Acme/UserBundle/Controller/twitter_includes/EpiOAuth.php');
 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Acme\UserBundle\Entity\Manufacturers;
use Acme\UserBundle\Entity\Customer;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Session\Session;

use Acme\UserBundle\Entity\Windows;
use Acme\UserBundle\Entity\Multiplers;
use Acme\UserBundle\Model\WindowsInterface; 


use Doctrine\ORM\Mapping as ORM;
 
class RegistrationController extends BaseController
{
	
	//Dealer Registration
    public function registerAction()
    {

        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled); 
		
        if ($process) 
		{
            $user = $form->getData();

            if ($confirmationEnabled) 
			{
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
               // $route = 'fos_user_registration_check_email';
			   return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:registerDuplicateEmail.html.'.$this->getEngine());
            } 
			else 
			{
                //$this->authenticateUser($user);
                //$route = 'fos_user_registration_confirmed';
				
				return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:registerSuccess.html.'.$this->getEngine());
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
          $url = $this->container->get('router')->generate($route); 

            return new RedirectResponse($url);
        } 
		else
		{
			$entityManager = $this->container->get('doctrine')->getEntityManager();
			$manufacturer= new Manufacturers($entityManager);
			$result=$entityManager->getRepository('UserBundle:Manufacturers')->findAll();


			return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
			'form' => $form->createView(),
			'theme' => $this->container->getParameter('fos_user.template.theme'),
			'result'=>$result,

			));
		}
		$entityManager = $this->container->get('doctrine')->getEntityManager();
		$manufacturer= new Manufacturers($entityManager);
		$result=$entityManager->getRepository('UserBundle:Manufacturers')->findAll();




        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
            'theme' => $this->container->getParameter('fos_user.template.theme'),
			'result'=>$result,
			
        ));
		
    }
	

	//User registration
	 public function userRegistrationAction()
    {
		$form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
		$url = $this->container->get('router')->generate('_get_started'); 
        $processUser = $formHandler->processUser($confirmationEnabled);
		 $url1 = $this->container->get('router')->generate('_paypal'); 
		
        if ($processUser) 
		{
            $user = $form->getData();

            if ($confirmationEnabled) 
			{
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else
			{
                $this->authenticateUser($user);
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
          $url = $this->container->get('router')->generate($route); 

            return new RedirectResponse($url);
        } else 
		//return new RedirectResponse($url);
		 return new RedirectResponse($url1);
	}
	
	
	
	//Home page 
    public function getStartedAction()
	{
				// echo"<pre>";
// print_r($_SESSION);
		$this->container->get('session')->clear();

		$form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
		
		 $process = $formHandler->process($confirmationEnabled); 
		 $url1 = $this->container->get('router')->generate('_paypal'); 
		
        if ($process)
		{
            $user = $form->getData();

            if ($confirmationEnabled) 
			{
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } 
			else 
			{
                //$this->authenticateUser($user);
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
          $url = $this->container->get('router')->generate($route); 

            return new RedirectResponse($url1);
        } 
		
		return $this->container->get('templating')->renderResponse('UserBundle:Registration:getStarted.html.php', array(
            'form' => $form->createView(),
        ));
	}
	
	public function twitterSignInAction() {

		$consumer_key='Ab9EIiPRDxIs9pPyJMaiHHU6g';
		$consumer_secret='zfTDOYSRT2IYDEo8AaCPpIdiy5YDUSWh1RKEQiO9xjHySAJQQc';

		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		
		 $authenticateUrl = $twitterObj->getAuthenticateUrl();
		 
		/* Redirect to the Twitter login page */
		return new RedirectResponse($authenticateUrl);
	}
	
	public function twitterReturnAction() {
		 echo "hi back";
		 $consumer_key='Ab9EIiPRDxIs9pPyJMaiHHU6g';
		$consumer_secret='zfTDOYSRT2IYDEo8AaCPpIdiy5YDUSWh1RKEQiO9xjHySAJQQc';
		 /* Once the user authenticates with Twitter they are redirected back to the callback url along with a "request token" called "oauth_token" This is the same "request token from login_to_twitter.php" */ 
		if (isset($_GET['oauth_token'])) {
		 
			$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
			 
			/* Use the setToken method to set the "access token" and "access token secret key" by using the "request token". We need these to later access the users information such as user name */
			$twitterObj->setToken($_GET['oauth_token']);
			$token = $twitterObj->getAccessToken();
			$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
			 
			/* Get user data from the twitter account
			* $screen_name is the @name
			* $twitter_id is the id of the user - one can change the @name but not the id
			* You can also get other types of information from the user here
			*/ 
			$userdata = $twitterObj->get_accountVerify_credentials();
			 
			 $twitter_id  = $userdata->id;
			 $screen_name = $userdata->screen_name; 
			 
			 //Set the session variables
			$_SESSION['twitter_id']  = $twitter_id;
			$_SESSION['screen_name']  = $screen_name; //This is the @name
			 
			if($twitter_id !='' && $screen_name != '') {
				 $url = $this->container->get('router')->generate('_paypal'); 
				return new RedirectResponse($url);
			}
		
		
		}
		
	}


	public function paypalAction()
	{	
		$session= $this->container->get("session");
		$manufact=$session->get('cartManufacturer');
		$amount=$session->get('cartManTotal');

		$paypal_url="";
		$paypal_url ="https://www.sandbox.paypal.com/cgi-bin/webscr"; 
		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$success=$this->container->get('router')->generate('_business',array(),true);
		$cancel=$this->container->get('router')->generate('_cancel',array(),true);
		$ipn=$this->container->get('router')->generate('_notify_url',array(),true);

		return $this->container->get('templating')->renderResponse('UserBundle:Registration:to_paypal.html.php',array('success'=>$success,'ipn'=>$ipn,'manufact'=>$manufact,'amount'=>$amount,'cancel'=>$cancel,'paypal_url'=>$paypal_url));

	}	


	//On payment sucess
	public function businessSuccessAction()
	{
	echo "<script>
	window.opener.location=\"http://phpdemo2.quagnitia.com/baselogic/web/app_dev.php/paymentSuccess\";
window.close();
	</script>";
		$this->container->get('session')->clear();
		$url='qsplus_1298546887_biz@gmail.com';
		$tab5="<div class=\"loginbox rounded\">
		<h2>Thank you!</h2>
		<p>Thank you for placing an order with us. We have received it. Our staff will contact you in next 24 hours.</p>
		</div>";
		$return=array("responseCode"=>200,  "tab"=>$tab5);
		$return=json_encode($return);
		return $this->container->get('templating')->renderResponse('UserBundle:Registration:paymentMessage.html.php');
	}	
	
	//On payemt cancel
	public function cancelPaymentAction()
	{
	echo "<script>
	window.opener.location=\"http://phpdemo2.quagnitia.com/baselogic/web/app_dev.php/paymentCancel\";
window.close();
	</script>";
		$this->container->get('session')->clear();
		$url='qsplus_1298546887_biz@gmail.com';
		$tab5="<h2>The order was canceled.</h2>";
		return $this->container->get('templating')->renderResponse('UserBundle:Registration:paymentMessage.html.php');
	}	
		
	
	public function ipnAction()
	{
		$ipn_data = array(); // contains the POST values for IPN
		if ($this->validate_ipn()) 
		{
			$subject = 'Instant Payment Notification - Recieved Payment';
			$to = 'EMAIL ADDRESS';
			$body="An instant payment notification was successfully recieved\n";
			$body .= "from ".$this->ipn_data['payer_email']." on ".date('m/d/Y');
			$body .= "\n\nDetails:\n";
			foreach ($this->ipn_data as $key => $value) 
			{
				$body .= "\n$key: $value";
			}
			@mail($to, $subject, $body);
		}

		$return=array("responseCode"=>200,  "tab"=>"hi");
		$return=json_encode($return);
		return new Response($return,200,array('Content-Type'=>'application/json'));
	}	
	
	
	function validate_ipn() 
	{
		$ipn_data = array(); // contains the POST values for IPN
		
		// parse the paypal URL
		$url_parsed=parse_url($this->paypal_url);
		
		// generate the post string from the _POST vars
		$post_string = '';
		foreach ($_POST as $field=>$value) 
		{
			$this->ipn_data["$field"] = $value;
			$post_string .= $field.'='.urlencode (stripslashes ($value)).'&';
		}
		$post_string.="cmd=_notify-validate";
		// open the connection to paypal
		$fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30);
		if(!$fp) 
		{
			// Print the error if not able to open the connection.
			$this->error = "Error no. $errnum: $errstr";
			$this->log_ipn_results(false);
			return false;
		} 
		else
		{
			// Post data back to paypal
			fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
			fputs($fp, "Host: $url_parsed[host]\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: ".strlen($post_string)."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $post_string . "\r\n\r\n");
			// loop through the response from the server and append to variable
			while(!feof($fp)) 
			{
				$this->ipn_response .= fgets($fp, 1024);
			}
			fclose($fp); // close connection
		}
		if (eregi("VERIFIED",$this->ipn_response)) 
		{
			// Valid IPN.
			$this->log_ipn_results(true);
			return true;
		} 
		else 
		{
			// Invalid IPN.
			$this->error = 'IPN Validation Failed.';
			$this->log_ipn_results(false);
			return false;
		}
	}
}