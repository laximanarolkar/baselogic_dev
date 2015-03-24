<?php

$testOptions = "none";
$track = 0;
$numOfItems=$_POST['numOfItems'];
$cartPrice=json_decode($_POST['cartPrice']);
$cartMan=json_decode($_POST['cartMan']);
$cartLine=json_decode($_POST['cartLine']);
$cartStyle=json_decode($_POST['cartStyle']);
$cartOptions=json_decode($_POST['cartOptions']);
$cartWidth=json_decode($_POST['cartWidth']);
$cartHeight=json_decode($_POST['cartHeight']);
$cartWindowNumber=json_decode($_POST['cartWindowNumber']);
$cartLocation=json_decode($_POST['cartLocation']);
$newWindowNumber=$_POST['newWindowNumber'];


?>
	
	<form action='cart/cart.php' method='post'>	
	<?php	for($i=0; $i<$numOfItems; $i++){
		if($cartPrice[$i]){
		?>
	<input type='hidden' name='productPrice[]' value='<?php echo $cartPrice[$i]?>'>
		<input type='hidden' name='productName[]' value='<?php echo $cartMan[$i]." ".$cartLine[$i]." ".$cartStyle[$i]." - Options: ".$cartOptions[$i]?>'>
			<input type='hidden' name='productMan[]' value='<?php echo $cartMan[$i]?>'>
		<input type='hidden' name='productLine[]' value='<?php echo $cartLine[$i]?>'>
		<input type='hidden' name='productStyle[]' value='<?php echo $cartStyle[$i]?>'>
		<input type='hidden' name='productOptions[]' value='<?php echo $cartOptions[$i]?>'>
		<input type='hidden' name='productWidth[]' value='<?php echo $cartWidth[$i]?>'>
		<input type='hidden' name='productHeight[]' value='<?php echo $cartHeight[$i]?>'>
		<input type='hidden' name='productWindowNumber[]' value ='<?php echo $cartWindowNumber[$i]?>'>
	<?php 	}
		}
		?>
<div class="add_win"><a href="javascript:void(0);" class="window_new" onclick='operationsObj.newWindowFunction()'>Add Window</a></div>
                            <div class="new_window_tbl">
                            	<div class="tbl_win">
                                	<table width="370px" border="0" cellspacing="0" cellpadding="0" class="new_wintbl">
                                    <?php   for($i=$newWindowNumber; $i>=0; $i--){ ?>
									  <tr class="head">
                                        <td colspan="4"  class="nobor"><strong>Window #: <?php echo $i+1 ?></strong></td>
                                        <td class="nobor"><a onClick='operationsObj.windowNumberFunction(<?php echo $i?>)' style="cursor:pointer"><img src="<?php echo $view['assets']->getUrl('bundles/userbundle/images/icon_newwin.png') ?>" width="28" height="27" alt="img" /></a></td>
                                      </tr>
									  <?php
									$num = $i+1;

									for($x=0; $x<$numOfItems; $x++){
									if($cartWindowNumber[$x] == $i){
									 ?>
                                      <tr>
                                     <?php 
									 
									 if ($num == $i+1){
									// $num = 1789;	?><td ><strong><?php echo $cartWidth[$x]." / " .$cartHeight[$x]." [".$cartOptions[$x]."] ".$cartStyle[$x] ?></strong></td><? }?>
                                        <td><?php echo $cartMan[$x]?></td>
                                        <td><?php echo $cartLine[$x] ?></td>
                                        <td><?php echo "$".$cartPrice[$x]?></td>
                                        <td class="nobor"><a href="javascript:void(0)" onclick='operationsObj.removeCartItem(" <?php echo $x?> ")'><img src="<?php echo $view['assets']->getUrl('bundles/userbundle/images/icon_close.png') ?>" width="14" height="16" alt="img" /></a></td>
                                      </tr>
                                  <?php 

											}
											}
										}
										}
?>	
                                    
                                    </table>

									<div id="pricetable" style="width:700px">
                                  
                            </div>
							</form>