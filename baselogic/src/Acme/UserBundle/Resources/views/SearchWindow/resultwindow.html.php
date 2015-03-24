<?php 
function sortArray($term,$window_product)
{
	$oldarr3= array();
	for($i=0;$i<$window_product['count'];$i++){	
	array_push($oldarr3,$window_product[$term][$i]);
	}
	
	sort($oldarr3);

	$j=0;
	$newarr3= array();
	for( $i=0;$i< count($oldarr3);$i++)
	{
	$newarr3[$j]=$oldarr3[$i];
	$j++;
	if(($i>0)&&($oldarr3[$i]==$oldarr3[$i-1]))
	{
		array_pop($newarr3);
		$j--;
	}
	}
	return $newarr3;
}
$winObj=json_decode($_POST['winObj']);


$Mywidth=$winObj->width;
$Myheight=$winObj->height;
$Myframe=$winObj->frame; 

$ListManufacturers=implode(",",$winObj->manufacturer); 

$options=implode(",",$winObj->options);
$ListStyles=implode(",",$winObj->style);
$ArrManufacturers=$winObj->manufacturer;
$ArrStyles=$winObj->style;
$ArrOptions=$winObj->options;
$entityManager = $container->get('doctrine')->getEntityManager();


	$optionsArray = $ArrOptions;


	$frame = strip_tags(substr($Myframe,0, 100));
	$frame = mysql_real_escape_string($frame); 


	$width = strip_tags(substr($Mywidth,0, 100));
	$width = mysql_real_escape_string($width);

	$height = strip_tags(substr($Myheight,0, 100));
	$height = mysql_real_escape_string($height); 

	$unitedinch = intval($height) + intval($width);

	if($width%6>=3){$callOutWidth = $width+(6-$width%6);}
	else if($width%6<3){$callOutWidth = $width-($width%6);}
	else {$callOutWidth = $width;}
	$width2 = $callOutWidth;
	if($height%6>=3){$callOutLength = $height+(6-$height%6);}
	else if($height%6<3){$callOutLength = $height-($height%6);}
	else{$callOutLength = $height;}
	$height2 = $callOutLength;
	$callOutWidth = floor($callOutWidth/12) . $callOutWidth%12;
	$callOutLength = floor($callOutLength/12) . $callOutLength%12;

	$callOut = $callOutWidth . $callOutLength;

	//fetch the entries from the db
	$query_result = $windows->getCustomQuery($ArrManufacturers,$ArrStyles,$frame,$width,$height,$unitedinch,$callOut);
	
     //put the result of the query in an array
	$window_product = $windows->window_function($query_result, $optionsArray);

	//if result found then display
if($window_product['count']>0)     
{

	$newarr = array();
	$newarr = sortArray("style",$window_product);
	$newarr2 = array();
	$newarr2 = sortArray("line",$window_product);
	for ($j=0;$j<count($newarr);$j++)
	{
		${'pricearr' . $j}= array();
	
		for ($b=0;$b<count($newarr2);$b++){
			for ($i=0;$i<$window_product['count'];$i++){
				if ($window_product['style'][$i] == $newarr[$j] && $window_product['line'][$i] == $newarr2[$b]){
				${'pricearr' . $j}[$b]=$window_product['base'][$i] ;
				}
			}
		} 
	} 

	$price_sort = array();
	//remove the duplicate entries
	for ($b=0;$b<count($newarr2);$b++){
	if(array_key_exists($b,$pricearr0))
	$price_sort[$b] = $pricearr0[$b].":".$newarr2[$b].":";
	else
	$price_sort[$b] = " :".$newarr2[$b].":";
	}
	
	
	sort($price_sort);
	$price_split = "";
	
	for ($b=0;$b<count($newarr2);$b++)
	{ 
		$price_split = $price_split.$price_sort[$b];
	}
 	$price_sort_line =array();
	$price_sort_price = array();
	$price_sort = array();

	
	for ($b=0;$b<count($price_split);$b++){
		$price_sort = explode(":",$price_split);
	}
	
	for ($i=0;$i<count($price_sort);$i++){
	
		if ($i%2==0 ){array_push($price_sort_price,$price_sort[$i]);}
		else{array_push($price_sort_line,$price_sort[$i]);}
		
	}


	$newarr2 = $price_sort_line;
	for ($j=0;$j<count($newarr);$j++){
		${'pricearr' . $j}= array();
		for ($b=0;$b<count($newarr2);$b++){
			for ($i=0;$i<$window_product['count'];$i++){
				if ($window_product['style'][$i] == $newarr[$j] && $window_product['line'][$i] == $newarr2[$b]){
				${'pricearr' . $j}[$b]=$window_product['base'][$i] ;
				}
			}
		} 
	}
		
		
	$heading = array();
	$obscure_price = array();
	$lowe_price = array();
	
	for ($b=0;$b<count($newarr2);$b++)
	{
		for ($i=0;$i<$window_product['count'];$i++)
		{
			if ($window_product['line'][$i] == $newarr2[$b])
			{   //put the manufaturer name and logo in an array
				$heading[$b]= "<img width=50 src='http://www.blpsinfo.com".$window_product['logo'][$i]."'><br \>";
				$heading[$b]= $heading[$b] . $window_product['manufacturer'][$i];
				$obscure_price[$b] = $window_product['obscure'][$i];
				$lowe_price[$b] = $window_product['lowe'][$i];
			}
		}
	}

/* find.php code ends */
?>

<div class="result_panel" id="IDResult_panel">
                          
	<h3>Results:</h3>
                                <div class="result_clm">
                                	<p><strong>Width:</strong> <?php echo $Mywidth ?> inch, <strong>Height:</strong><?php echo $Myheight ?> inch</p>
                                	<p><strong>Frame Type: </strong><?php echo $Myframe ?> , </p>
	                                <p><strong>Options:</strong> <?php echo $options ?> </p>
                                </div>
  	
                            </div>
							
	 <div class="manf_type_lrgone"><div>
                    	        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="srch_resulttblone" id="main_table">
                                  <tr>
                                    <td height="63" style="vertical-align:middle;"><strong>Manufacturers</strong></td>
                                    <td rowspan="5" style="padding:0" width="370">
                                    	<div class="manfactures">
                                        	<div class="manfacture_inner">
                                    			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="rows_result">
                                                  <tr>
												  <?php for ($i=0;$i<count($heading);$i++)
												  {												  
												  ?>
                                                  <td align ='center' width="50px">  <p><a href = '' id = 'toggleit<?php echo $i?>' ><?php echo $heading[$i]?></a></p></td>
                                                  <?php } ?>
                                                    
                                                  </tr>
                                                  <tr>
                                                 <?php  	for ($i=0;$i<count($newarr2);$i++){
												 ?>
												 <td align = 'center' height="37px"><a href = '' id = 'toggleit<?php echo $i?>' ><?php echo $newarr2[$i]?></a></td>
												 <?php } ?>
                                                  </tr>
												
												  <?php 
												  	for ($j=0;$j<count($newarr);$j++){ 
													?><tr class="bluebg" id="newarr_<?php echo $j; ?>">
													<?php
													for ($b=0;$b<count($newarr2);$b++)
																								{
														if(array_key_exists($b,${'pricearr' . $j}))
														$newstring = ${'pricearr' . $j}[$b];
														else
														$newstring ="";
														if ($newstring=="")
																{?>
														<td align ='right' ><a href = 'javascript:void(null);' id = 'toggleit<?php echo $b?>' ><?php echo "n/a"; ?></a></td>
														 <?php  }
														else { 
														$string = $heading[$b]; 
														$start = strrpos($string,'<br \>') + 6;
														$length = strlen($string);
														$manufact = substr($string,$start,$length);		?>
															<td align ='right' >
															<a href = 'javascript:void(null);' id = 'toggleit<?php echo $b?>' onclick ="operationsObj.addToCart('<?php echo $newstring?>','<?php echo$newarr[$j]?>','<?php echo $newarr2[$b]?>','<?php echo $manufact?>','<?php echo $options?>')"><?php echo "$".$newstring ?>
															</a></td>
													<?php  }
													} ?>
													
											</tr>
											<?php
											}	 ?>
									
                                            
                                                </table>
                                        	</div>
                                        </div>
                                    </td>
                                    <td class="nobor" style="vertical-align:middle;"><strong>Style</strong></td>
                                  </tr>
                                  <tr>
                                    <td style="vertical-align:middle;height:37px"><strong>Line</strong></td>
                                    <td class="nobor"></td>
                                  </tr>
                                  <tr class="bggray">
                                    <td rowspan="3" style="vertical-align:middle;"><strong> Price</strong></td>
                                    <td class="nobor" rowspan="3" id="sort_td">
								
                                    	<?php  	for ($j=0;$j<count($newarr);$j++){
											?>
										<div class="style_icon" id="div_<?php echo $j;?>">
										
										<a href='#top' rel='top' class='control' id="sort_<?php echo $j;?>">
										<img src="<?php echo $view['assets']->getUrl('bundles/userbundle/images/icon_style.jpg') ?>" width="16" height="16" alt="img" /></a><?php echo $newarr[$j]?>
										</div>
                                      <?php }?>
									
                                    </td>
                                  </tr>
								  <tr>
								<?php   /*for ($i=0;$i<count($obscure_price);$i++){?>
		<td align ='right' ><div class='obscure' ><a id = 'toggleit<?php echo $i?>' ><?php echo $obscure_price[$i] ?></a></div></td>
	<?php } ?>
<td align='right'><div class='obscure'>Obscure</div></td>
	</tr>
	<tr>
	<?php 
	for ($i=0;$i<count($lowe_price);$i++){?>
		<td align ='right' ><div class='lowe' ><a id = 'toggleit<?php echo $i?>' ><?php echo $lowe_price[$i]?></a></div></td>
<?php	} ?>
	<td align='right'><div class='lowe'>Lowe</div></td>
	</tr>
	
	
	*/?>
                                </table>
								</div>	
								
								 </div>			

<?php }  else echo "NO results found."?>