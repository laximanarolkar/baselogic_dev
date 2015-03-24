<?php $maxlevel=$_POST['maxlevel']; 
$brands=$_POST['brands']; 
      for($i=0; $i<1; $i++) { 
	?>
	<div class='levelinfo'>
		<table id="lv" class="mytb"><tr><td> </td></tr><tr><td> </td></tr>
	<?php
        for($lv=0; $lv<=$maxlevel; $lv++) {
			$ld = $levelData[$lv]; 
			$ww = $ld[0][0].'x'.$ld[0][1].' '.$ld[1].' '.$ld[2];
			 $lv++;
			?>
			
			<tr><td align="right"><?php echo $lv.$ww;?></td>
			</tr>
	<?php	} ?>
		<tr><td>  </td></tr></table></div>
	  	<?php	} print_r($brands);
		$firstbrand = false;
	/*  foreach($brands as $brand) { 
        $curbrand = $brands[$brand]; 
        $cls = $curbrand->merged ? 'drkgraybg' : 'graybg';}
        
   */
            
		?>
		