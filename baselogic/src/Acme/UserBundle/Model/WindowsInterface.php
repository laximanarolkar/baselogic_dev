<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\UserBundle\Model;

use Acme\UserBundle\Entity\ApplicationBoot;

/**
 * Storage agnostic user object
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class WindowsInterface 
{
  
protected $entityManager ;
protected $container ;
		public function __construct() {
			  $this->container = ApplicationBoot::getContainer();
		$this->entityManager = $this->container->get('doctrine')->getEntityManager();
			
			}

			
			public function getCustomQuery($ListManufacturers,$ListStyles,$frame,$width,$height,$unitedinch,$callout)
    {
	//$sql = "SELECT * FROM windows  WHERE ($term) AND ($style) AND frame = '$frame' AND ((width = '$width2' AND height = '$height2') OR (ui = $unitedinch) OR ($callOut)) ORDER BY base,style";
     
$query = $this->entityManager->createQuery(
    'SELECT w FROM UserBundle:Windows w WHERE w.manufacturer in (:ListManufacturers) and w.style in (:ListStyles) and w.frame=:frame and ((w.width = :width AND w.height = :height) OR (w.ui =:unitedinch) OR (w.callout=:callout)) ORDER BY w.base,w.style'
)->setParameters(array('ListManufacturers'=>$ListManufacturers,
'ListStyles'=>$ListStyles,
'frame'=>$frame,'width'=>$width,'height'=>$height,'unitedinch'=>$unitedinch,'callout'=>$callout));

$windowsResult = $query->getResult();
	   return $windowsResult;
    }
	
	
	public function window_function($result, $optionsArray)
{
$window_product = array();
$window_product['count'] = count($result);
$window_product['id'] = array();
$window_product['logo']= array();
$window_product['line'] = array();
$window_product['base'] = array();
$window_product['lowe'] = array();
$window_product['obscure'] = array();
$window_product['structured'] = array();

$string = "<br \>";
if (count($result) > 0){
	
	$obscure = 0;
	$lowe = 0;
	$tempered = 0;
	$argon = 0;
	$flat = 0;
	$sculptured =0;
	if (isset ($optionsArray)){
		foreach($optionsArray as $value){
			if ($value == "obscure") {$obscure = 1;}
			if ($value == "lowe") {$lowe = 1;}
			if ($value == "tempered") {$tempered = 1;}
			if ($value == "argon") {$argon = 1;}
			if ($value == "flat") {$flat = 1;}
			if ($value == "sculptured") {$sculptured = 1;}
		}
	}
	$i = 0;
 foreach($result as $row){
  	//$sql_logo = "SELECT logo FROM manufacturers WHERE name = '". $row->getManufacturer()."'"; 
 $sql_logo=$this->entityManager->getRepository('UserBundle:Manufacturers')->findOneBy(array('name'=>$row->getManufacturer()));
	$logo_string = $sql_logo->getLogo();
	//$logo_string = mysql_fetch_object($result_logo);
	
  	$window_product['id'][] = $row-> getId();
  	$window_product['manufacturer'][] = $row-> getManufacturer();
	$window_product['style'][] = $row-> getStyle();
	$window_product['logo'][] = $logo_string;
	$window_product['line'][] = $row->getLine();
    $window_product['base'][] =  round($row->getBase());
	$window_product['lowe'][] = round($row->getLowe());
	$window_product['obscure'][] = round($row->getObscure());
	$window_product['tempered'][] = round($row->getTempered());
	$window_product['argon'][] = round($row->getArgon());
	$window_product['flat'][] = round($row->getFlat());
	$window_product['sculptured'][] = round($row->getSculptured());
	
	//foreach($optionsArray as $value){$window_product['base'][$i] += $value;}
	if($obscure == 1){$window_product['base'][$i] += $window_product['obscure'][$i];}
	if($lowe == 1){$window_product['base'][$i] += $window_product['lowe'][$i];}
	if($tempered == 1){$window_product['base'][$i] += $window_product['tempered'][$i];}
	if($argon == 1){$window_product['base'][$i] += $window_product['argon'][$i];}
	if($flat == 1){$window_product['base'][$i] += $window_product['flat'][$i];}
	if($sculptured == 1){$window_product['base'][$i] += $window_product['sculptured'][$i];}
	
	$i++;
	}
	
}else{
  $string = "No matches!";
}
return $window_product;
} 


}
