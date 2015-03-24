<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Base Logic</title>

<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/style/css/style.css') ?>" rel="stylesheet"  />
<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/style/css/jquery-ui-tab.css')?>" rel="stylesheet"  />
<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/style/css/jquery.loader.css')?>" rel="stylesheet"  />

<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/css/admin.css')?>" rel="stylesheet"  />

  
   
<body onLoad="document.forms['paypal_form'].submit();">
 <div id="header">
    <!--<div class="container">
      <div class="logo"><a href="index.html"><img src="<?php //echo $view['assets']->getUrl('bundles/userbundle/style/images/logo.png') ?>" alt="baseLOGIC" title="baseLOGIC" /></a></div>
    </div>-->
    <!--<div class="nav">
      <div class="container">
        
      </div>
    </div>-->
  </div>
<div id="middle">

		<center><h3 style="color:#1f3a7f;padding-bottom:20px">Please wait, your order is being processed and you will be redirected to the paypal website.....</h3>
		<p style="color:red">Please do not close or click back.</p></center>
		
		<form method="post" name="paypal_form" action="<?php echo $paypal_url; ?>" target="_blank">

		<input type="hidden" name="rm" value="2" >
		<input type="hidden" name="cmd" value="_xclick" >
		<input type="hidden" name="business" value="qsplus_1298546887_biz@gmail.com" >
		<input type="hidden" name="return" value="<?php echo $success; ?>" >
		<input type="hidden" name="cancel_return" value="<?php echo $cancel;?>" >
		<input type="hidden" name="notify_url" value="<?php echo $ipn;?>" >
		<input type="hidden" name="item_name" value="<?php echo $manufact;?>" >
		<input type="hidden" name="amount" value="<?php echo $amount;?>" >
		<input type="hidden" name="currency_code" value="USD" >

		<center><br/><br/><p style="color:#1f3a7f;">If you are not automatically redirected to paypal within 5 seconds...<p><br/><br/>
		<input type="submit" value="Click Here"></center>
		</form>
		
</div>

<div id="footer">
	<div class="container">Copyright © <?php echo date('Y');?> All rights reserved.</div>
</div>
</body>

